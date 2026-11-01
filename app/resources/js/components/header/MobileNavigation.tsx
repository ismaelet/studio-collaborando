import { useHeader } from "./HeaderContext";

import MobileLink from "./MobileLink";
import styles from "./MobileNavigation.module.css";

import type { NavigationLink } from "@/types/header";

export default function MobileNavigation({ links }: { links: NavigationLink[] }) {
  const { toggleNavigation } = useHeader();

  return (
    <nav
      className={`${styles.mobileNavigation} bg-background-400 grid items-center transition-opacity`}
    >
      <ul className="flex flex-col justify-between gap-8 text-center sm:gap-16">
        {links.map((link, index) => (
          <MobileLink key={index} link={link} onClick={() => toggleNavigation(false)}>
            {link.label}
          </MobileLink>
        ))}
      </ul>
    </nav>
  );
}
