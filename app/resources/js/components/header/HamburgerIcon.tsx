import { useHeader } from "./HeaderContext";
import styles from "./HamburgerIcon.module.css";

export default function HamburgerIcon({ className }: { className?: string }) {
  const { toggleNavigation } = useHeader();

  return (
    <div
      className={`hamburger-icon ${styles.hamburgerIcon} text-heading-400 stack-content grid cursor-pointer items-center justify-items-end ${className ?? ""}`}
      data-type="default"
      onClick={() => toggleNavigation()}
    >
      <span className="bg-neutral-text"></span>
      <span className="bg-neutral-text"></span>
      <span className="bg-neutral-text"></span>
    </div>
  );
}
