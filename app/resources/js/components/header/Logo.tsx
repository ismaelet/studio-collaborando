import logo from "@images/logo-256.webp";

export default function Logo({ className }: { className?: string }) {
  return (
    <div
      className={`grid grid-cols-[max-content_minmax(0,1fr)] items-center gap-4 ${className ?? ""}`}
    >
      <a href="/">
        <img src={logo} alt="Logo" className="w-14 shrink-0" />
      </a>

      <div>
        <p className="font-heading text-secondary-500 text-2xl font-medium">Michael Ende</p>
        <p className="text-neutral-text text-sm uppercase">Die Unendliche Geschichte</p>
      </div>
    </div>
  );
}
