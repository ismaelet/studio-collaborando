import SearchButton from "./SearchButton";
import WatchlistButton from "./WatchlistButton";
import HamburgerIcon from "./HamburgerIcon";
import HeaderLogo from "./Logo";
import MobileNavigation from "./MobileNavigation";
import type { NavigationLink } from "@/types/header";

type MobileHeaderProps = {
  links: NavigationLink[];
  className?: string;
};

export default function MobileHeader({ links, className }: MobileHeaderProps) {
  return (
    <section
      className={`mobile-header grid grid-cols-[minmax(0,1fr)_0fr_auto] items-center gap-2 px-4 py-2 md:px-8 md:py-4 ${className ?? ""}`}
    >
      {/* Left bar */}
      <div className="flex items-center gap-4">
        <HeaderLogo className="hidden md:flex" />
        <SearchButton className="md:hidden" />
      </div>

      {/* Center bar */}
      <div className="flex items-center justify-center gap-4"></div>

      {/* Right bar */}
      <div className="flex items-center justify-end gap-4">
        <SearchButton className="hidden md:grid" />
        <WatchlistButton />
        <HamburgerIcon className="relative z-10" />
      </div>

      {/* Mobile navigation */}
      <MobileNavigation links={links} />
    </section>
  );
}
