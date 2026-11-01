<script lang="ts">
  let { className = "" }: { className?: string } = $props();
  let searching = $state(false);
  let searchInput: HTMLInputElement;

  function toggleSearch() {
    if (searching) {
      searching = false;
      searchInput?.blur();
    } else {
      searching = true;
      searchInput?.focus();
    }
  }

  function closeSearch() {
    searching = false;
    searchInput?.blur();
  }

  function onFocusOut(event: FocusEvent & { currentTarget: HTMLFormElement }) {
    const nextTarget = event.relatedTarget;
    if (nextTarget instanceof Node && event.currentTarget.contains(nextTarget)) return;

    closeSearch();
  }
</script>

<form
  method="GET"
  action="/search"
  class={`header-search group grid w-full max-w-80 grid-cols-[max-content_0fr] transition-all has-[input:focus]:grid-cols-[max-content_1fr] md:grid-cols-[0fr_max-content] md:justify-end md:has-[input:focus]:grid-cols-[1fr_max-content] ${className}`}
  autocomplete="off"
  onfocusout={onFocusOut}
>
  <button
    type="button"
    class="hover:text-primary-300 border-border-400 row-start-1 aspect-square w-12 cursor-pointer rounded-lg border transition-all group-has-[input:focus]:rounded-br-none md:col-start-2 md:group-has-[input:focus]:rounded-br-lg md:group-has-[input:focus]:rounded-bl-none text-heading-400"
    onclick={toggleSearch}
    title="Suche"
  >
    <svg class="m-auto h-5 w-5" viewBox="4 4 24 24" aria-hidden="true" focusable="false">
      <path
        fill="currentColor"
        d="M27.414 24.586l-5.077-5.077C23.386 17.928 24 16.035 24 14c0-5.514-4.486-10-10-10S4 8.486 4 14s4.486 10 10 10c2.035 0 3.928-.614 5.509-1.663l5.077 5.077c.78.781 2.048.781 2.828 0 .781-.781.781-2.047 0-2.828ZM7 14c0-3.86 3.14-7 7-7s7 3.14 7 7-3.14 7-7 7-7-3.14-7-7Z"
      />
    </svg>
    <span class="visually-hidden">Suchleiste öffnen</span>
  </button>

  <label class="overflow-hidden">
    <input
      bind:this={searchInput}
      type="search"
      name="search"
      class="header-search-input border-border-400 h-full w-full rounded-none border-b bg-transparent px-2 text-lg transition-all outline-none"
      placeholder="Suche..."
    />

    <span class="visually-hidden">Suche</span>
  </label>
</form>
