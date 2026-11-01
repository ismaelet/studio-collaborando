import { Fragment } from "react";
import DesktopLink from "./DesktopLink";
import type { NavigationLink } from "@/types/header";

export default function DesktopNavigation({ links }: { links: NavigationLink[] }) {
  return (
    <nav className="desktop-navigation">
      <ul className="flex items-center gap-8">
        {links.map((link, index) => (
          <Fragment key={index}>
            <DesktopLink link={link} />

            {index < links.length - 1 && (
              <span className="font-alt text-primary-400 cursor-default text-lg">//</span>
            )}
          </Fragment>
        ))}
      </ul>
    </nav>
  );
}
