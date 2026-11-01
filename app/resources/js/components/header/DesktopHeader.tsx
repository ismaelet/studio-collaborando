import DesktopNavigation from "./DesktopNavigation";
import HeaderLogo from "./Logo";
import SearchButton from "./SearchButton";
import WatchlistButton from "./WatchlistButton";
import type { NavigationLink } from "@/types/header";

type DesktopHeaderProps = {
  links: NavigationLink[];
  className?: string;
};

export default function DesktopHeader({ links, className }: DesktopHeaderProps) {
  return (
    <div
      className={`desktop-header grid-cols-[1fr_max-content_1fr] gap-4 px-8 py-2.5 ${className ?? ""}`}
    >
      {/* Left bar */}
      <div className="flex items-center justify-start gap-4">
        <HeaderLogo />
      </div>

      {/* Center bar */}
      <div className="flex items-center justify-center gap-4">
        <DesktopNavigation links={links} />
      </div>

      {/* Right bar */}
      <div className="flex items-center justify-end gap-4">
        <SearchButton />
        <WatchlistButton />
      </div>
    </div>
  );
}
