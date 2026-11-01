<script>
  export let name
  const icons = import.meta.glob(['../../svg/logo/{logo-primary,header-logo}.svg', '../../svg/icons/contacts/{instagram,facebook,email,whatsapp,phone}.svg', '../../svg/icons/{user,documents,courses}.svg'], { query: '?raw', import: 'default', eager: true })
  $: svg = icons[`../../svg/${name}.svg`] || ''
</script>
<span class="icon-embed" aria-hidden="true">{@html svg}</span>
