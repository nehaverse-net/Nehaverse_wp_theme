(() => {
  const config = window.NehaverseStatusConfig || {};

  const formatLatency = (value) => Number.isFinite(value) ? `${Math.round(value)} ms` : '—';

  function updateCard(root, service) {
    if (!['website', 'minecraft'].includes(service.id)) return;
    const card = root.querySelector(`[data-service="${service.id}"]`);
    if (!card) return;
    card.setAttribute('aria-busy', 'false');
    const pill = card.querySelector('.nhv-status__pill');
    pill.className = `nhv-status__pill ${service.online ? 'is-online' : 'is-offline'}`;
    pill.querySelector('b').textContent = service.online ? '稼働中' : '停止中';
    card.querySelector('[data-metric="latency"]').textContent = formatLatency(service.latencyMs);

    if (service.id === 'website') {
      card.querySelector('[data-metric="detail"]').textContent = service.statusCode
        ? `${service.statusCode} ${service.statusText || ''}`.trim()
        : '応答なし';
      return;
    }

    card.querySelector('[data-metric="players"]').textContent = service.online && service.players
      ? `${service.players.online} / ${service.players.max}`
      : '—';
    card.querySelector('[data-metric="version"]').textContent = service.online
      ? `${service.version?.name || 'Minecraft'} • ${service.description || 'Online'}`
      : (service.error || 'サーバーから応答がありません');
  }

  function updateSummary(root, data) {
    const online = data.services.filter((service) => service.online).length;
    const total = data.services.length;
    const dot = root.querySelector('[data-summary-dot]');
    const title = root.querySelector('[data-summary-title]');
    const copy = root.querySelector('[data-summary-copy]');
    dot.className = 'nhv-status__summary-dot';

    if (online === total) {
      dot.classList.add('is-online');
      title.textContent = 'すべてのシステムが正常です';
      copy.textContent = '現在、確認されている障害はありません。';
    } else if (online === 0) {
      dot.classList.add('is-down');
      title.textContent = 'サービスに接続できません';
      copy.textContent = '複数のサービスで応答を確認できませんでした。';
    } else {
      dot.classList.add('is-degraded');
      title.textContent = '一部サービスに問題があります';
      copy.textContent = '現在、応答していないサービスがあります。';
    }

    const checkedAt = new Date(data.checkedAt);
    const time = root.querySelector('[data-last-checked]');
    time.dateTime = checkedAt.toISOString();
    time.textContent = checkedAt.toLocaleTimeString('ja-JP', { hour12: false });
  }

  function showConfigurationError(root) {
    root.querySelector('[data-summary-dot]').className = 'nhv-status__summary-dot is-degraded';
    root.querySelector('[data-summary-title]').textContent = '稼働状況は現在表示していません';
    root.querySelector('[data-summary-copy]').textContent = '最新の案内はDiscordコミュニティでご確認ください。';
    resetCards(root, '未確認');
    root.querySelector('[data-status-refresh]').disabled = true;
    root.querySelector('.nhv-status__footer p').textContent = '稼働状況の自動更新は停止しています。';
  }

  function resetCards(root, label) {
    root.querySelectorAll('[data-service]').forEach((card) => {
      card.setAttribute('aria-busy', 'false');
      card.querySelector('.nhv-status__pill').className = 'nhv-status__pill';
      card.querySelector('.nhv-status__pill b').textContent = label;
      card.querySelectorAll('[data-metric]').forEach((metric) => {
        metric.textContent = metric.dataset.metric === 'version' ? 'Discordで最新情報をご確認ください。' : '—';
      });
    });
    const time = root.querySelector('[data-last-checked]');
    time.removeAttribute('datetime');
    time.textContent = '--:--:--';
  }

  function setup(root) {
    let refreshing = false;

    const refresh = async () => {
      if (refreshing) return;
      if (!config.apiUrl) {
        showConfigurationError(root);
        return;
      }
      refreshing = true;
      try {
        const response = await fetch(config.apiUrl, { headers: { Accept: 'application/json' }, signal: AbortSignal.timeout(10000) });
        if (!response.ok) throw new Error(`Status API ${response.status}`);
        const data = await response.json();
        if (!Array.isArray(data.services) || data.services.length !== 2 ||
            !['website', 'minecraft'].every((id) => data.services.some((service) => service?.id === id && typeof service.online === 'boolean')) ||
            typeof data.checkedAt !== 'string' || !Number.isFinite(new Date(data.checkedAt).getTime())) {
          throw new Error('Invalid Status API response');
        }
        data.services.forEach((service) => updateCard(root, service));
        updateSummary(root, data);
      } catch (error) {
        resetCards(root, '取得失敗');
        root.querySelector('[data-summary-dot]').className = 'nhv-status__summary-dot is-down';
        root.querySelector('[data-summary-title]').textContent = 'ステータスを取得できません';
        root.querySelector('[data-summary-copy]').textContent = 'しばらくしてから、もう一度お試しください。';
        console.error('[Nehaverse Status]', error);
      } finally {
        refreshing = false;
      }
    };

    root.querySelector('[data-status-refresh]').addEventListener('click', refresh);
    root.querySelector('[data-copy]').addEventListener('click', async (event) => {
      const toast = root.querySelector('[data-status-toast]');
      const address = event.currentTarget.dataset.copy;
      try {
        await navigator.clipboard.writeText(address);
        toast.textContent = 'アドレスをコピーしました';
      } catch {
        toast.textContent = `コピーできませんでした。接続先: ${address}`;
      }
      toast.classList.add('is-visible');
      window.setTimeout(() => toast.classList.remove('is-visible'), 1800);
    });

    refresh();
    if (config.apiUrl) {
      const interval = Math.max(10000, Number(config.refreshInterval) || 60000);
      root.querySelector('.nhv-status__footer p').textContent = `表示は${interval / 1000}秒ごとに自動更新されます。`;
      window.setInterval(refresh, interval);
    }
  }

  document.querySelectorAll('[data-nehaverse-status]').forEach(setup);
})();
