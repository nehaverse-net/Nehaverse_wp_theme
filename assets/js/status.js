(() => {
  const config = window.NehaverseStatusConfig || {};

  const formatLatency = (value) => Number.isFinite(value) ? `${Math.round(value)} ms` : '—';

  function updateCard(root, service) {
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
    root.querySelector('[data-summary-title]').textContent = 'Status APIが未設定です';
    root.querySelector('[data-summary-copy]').textContent = 'WordPress管理画面の「設定 → Nehaverse Status」でAPI URLを入力してください。';
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
        const response = await fetch(config.apiUrl, { headers: { Accept: 'application/json' } });
        if (!response.ok) throw new Error(`Status API ${response.status}`);
        const data = await response.json();
        data.services.forEach((service) => updateCard(root, service));
        updateSummary(root, data);
      } catch (error) {
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
      await navigator.clipboard.writeText(event.currentTarget.dataset.copy);
      const toast = root.querySelector('[data-status-toast]');
      toast.classList.add('is-visible');
      window.setTimeout(() => toast.classList.remove('is-visible'), 1800);
    });

    refresh();
    window.setInterval(refresh, Number(config.refreshInterval) || 60000);
  }

  document.querySelectorAll('[data-nehaverse-status]').forEach(setup);
})();
