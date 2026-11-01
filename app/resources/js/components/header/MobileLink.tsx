import type { MouseEventHandler, ReactNode } from "react";
import type { NavigationLink } from "@/types/header";

type MobileLinkProps = {
  link: NavigationLink;
  style?: React.CSSProperties;
  onClick?: MouseEventHandler<HTMLLIElement>;
  children?: ReactNode;
};

export default function MobileLink({ link, style, onClick, children }: MobileLinkProps) {
  return (
    <li style={style} onClick={onClick}>
      <a
        className="font-heading hover:text-primary text-xl tracking-wider transition-colors sm:text-2xl"
        href={link.route}
      >
        {children}
      </a>
    </li>
  );
}
