<script lang="ts">
  import { getContext } from "svelte";
  import { HEADER_CONTEXT, type HeaderContextValue, type NavigationLink } from "./HeaderContext";

  let { link }: { link: NavigationLink } = $props();
  const header = getContext<HeaderContextValue>(HEADER_CONTEXT);
  const isActive = $derived(link.locationTag === header.currentLocation);
</script>

<li class="desktop-navigation__link">
  <a
    href={link.route}
    class={`text-heading-400 hover:text-primary-300 px-1 py-5 text-xl transition-colors ${isActive ? "font-semibold" : ""}`}
    data-active={isActive}
  >
    {link.label}
  </a>
</li>
