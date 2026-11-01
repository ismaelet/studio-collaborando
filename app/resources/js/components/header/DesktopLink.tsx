import { useHeader } from "./HeaderContext";
import type { NavigationLink } from "@/types/header";

export default function DesktopLink({ link }: { link: NavigationLink }) {
  const { currentLocation } = useHeader();
  const isActive = link.locationTag == currentLocation;

  return (
    <li className="desktop-navigation__link">
      <a
        href={link.route}
        className={`text-heading-400 hover:text-primary-300 px-1 py-5 text-xl transition-colors ${isActive ? "font-semibold" : ""}`}
        data-active={isActive}
      >
        {link.label}
      </a>
    </li>
  );
}
