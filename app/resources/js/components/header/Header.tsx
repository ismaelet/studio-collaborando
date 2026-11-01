import { useEffect, useRef, useState } from "react";
import DesktopHeader from "./DesktopHeader";
import MobileHeader from "./MobileHeader";
import { HeaderContext } from "./HeaderContext";
import type { NavigationLink } from "@/types/header";

const allowFloatingHeader = false;

const links: NavigationLink[] = [
  { label: "Home", route: "home", locationTag: "home" },
  { label: "Zeitleiste", route: "timeline", locationTag: "timeline" },
  { label: "Inhalt", route: "documents", locationTag: "documents" },
  { label: "Suche", route: "search", locationTag: "search" },
];

export default function Header({ currentLocation }: { currentLocation?: string }) {
  const headerRef = useRef<HTMLElement>(null);
  const containerRef = useRef<HTMLDivElement>(null);
  const [navigationIsOpen, setNavigationIsOpen] = useState(false);

  useEffect(() => {
    const header = headerRef.current;

    const syncHeight = () => {
      if (allowFloatingHeader || !header || !containerRef.current) return;

      containerRef.current.style.height = `${header.offsetHeight}px`;
    };

    syncHeight();

    const resizeObserver = new ResizeObserver(syncHeight);
    if (header) resizeObserver.observe(header);
    window.addEventListener("resize", syncHeight);

    return () => {
      resizeObserver.disconnect();
      window.removeEventListener("resize", syncHeight);
    };
  }, []);

  const toggleNavigation = (open?: boolean) =>
    setNavigationIsOpen((current) => (typeof open === "boolean" ? open : !current));

  return (
    <HeaderContext.Provider value={{ currentLocation, navigationIsOpen, toggleNavigation }}>
      <div ref={containerRef}>
        <header
          ref={headerRef}
          className="fixed top-0 left-0 z-10 w-full bg-background-300/80 shadow-2xl/5 backdrop-blur-md transition-colors"
          data-navigation-open={navigationIsOpen}
        >
          <DesktopHeader className="hidden lg:grid" links={links} />
          <MobileHeader className="lg:hidden" links={links} />
        </header>
      </div>
    </HeaderContext.Provider>
  );
}
