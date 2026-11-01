<script>
  export let name
  export let label = ''
  export let type = 'text'
  export let value = ''
  export let error = ''
  export let required = false
  export let placeholder = ''
</script>
<div class="form-field grid gap-2">
  {#if label}<label for={name}>{label}</label>{/if}
  <input id={name} {name} {type} bind:value {required} {placeholder} class="input" aria-invalid={!!error} aria-describedby={error ? `${name}-error` : undefined} {...$$restProps} />
  {#if error}<p id={`${name}-error`} class="error-warning" role="alert">{error}</p>{/if}
</div>
