<script lang="ts">
  import SearchButton from "./SearchButton.svelte";
  import WatchlistButton from "./WatchlistButton.svelte";
  import HamburgerIcon from "./HamburgerIcon.svelte";
  import HeaderLogo from "./Logo.svelte";
  import MobileNavigation from "./MobileNavigation.svelte";
  import type { NavigationLink } from "./HeaderContext";

  let { links, className = "" }: { links: NavigationLink[]; className?: string } = $props();
</script>

<section
  class={`mobile-header grid grid-cols-[minmax(0,1fr)_0fr_auto] items-center gap-2 px-4 py-2 md:px-8 md:py-4 ${className}`}
>
  <div class="flex items-center gap-4">
    <HeaderLogo className="hidden md:flex" />
    <SearchButton className="md:hidden" />
  </div>

  <div class="flex items-center justify-center gap-4"></div>

  <div class="flex items-center justify-end gap-4">
    <SearchButton className="hidden md:grid" />
    <WatchlistButton />
    <HamburgerIcon className="relative z-10" />
  </div>

  <MobileNavigation {links} />
</section>
