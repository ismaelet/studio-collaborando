<script>
  import { Link } from '@inertiajs/svelte'
  export let href = null
  export let type = 'button'
  export let variant = 'primary'
  export let size = 'regular'
  export let disabled = false
</script>
{#if href}
  {#if href.startsWith('#')}
    <a {href} class="button" data-variant={variant} data-size={size} {...$$restProps}><slot /></a>
  {:else}
    <Link {href} class="button" data-variant={variant} data-size={size} {...$$restProps}><slot /></Link>
  {/if}
{:else}
  <button {type} {disabled} class="button" data-variant={variant} data-size={size} {...$$restProps}><slot /></button>
{/if}
