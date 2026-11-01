<script lang="ts">
  import DesktopNavigation from "./DesktopNavigation.svelte";
  import HeaderLogo from "./Logo.svelte";
  import SearchButton from "./SearchButton.svelte";
  import WatchlistButton from "./WatchlistButton.svelte";
  import type { NavigationLink } from "./HeaderContext";

  let { links, className = "" }: { links: NavigationLink[]; className?: string } = $props();
</script>

<div class={`desktop-header grid-cols-[1fr_max-content_1fr] gap-4 px-8 py-2.5 ${className}`}>
  <div class="flex items-center justify-start gap-4">
    <HeaderLogo />
  </div>

  <div class="flex items-center justify-center gap-4">
    <DesktopNavigation {links} />
  </div>

  <div class="flex items-center justify-end gap-4">
    <SearchButton />
    <WatchlistButton />
  </div>
</div>
