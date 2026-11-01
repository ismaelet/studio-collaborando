import "./header.css";

export default function LoginButton() {
  return (
    <a
      className="login-button font-heading text-secondary-600 transition-colors hover:text-primary xl:text-lg dark:text-neutral-950"
      href="/register"
    >
      Anmelden
    </a>
  );
}
