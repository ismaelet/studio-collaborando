import { useEffect, useState, type ReactNode } from "react";

type ThemeType = "light" | "dark" | "system";
type BinaryThemeType = "light" | "dark";

const defaultTheme: BinaryThemeType = "light";

function getTheme(): ThemeType {
  return (localStorage.getItem("theme") as ThemeType | null) || defaultTheme;
}

function getSystemTheme(): BinaryThemeType {
  return window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
}

function applyTheme(theme: ThemeType): void {
  localStorage.setItem("theme", theme);

  const binaryTheme = theme === "system" ? getSystemTheme() : theme;

  document.documentElement.classList.toggle("dark", binaryTheme === "dark");
}

const iconProps = {
  viewBox: "0 0 28 28",
  fill: "none",
  "aria-hidden": true,
  focusable: false,
} as const;

const options: { value: ThemeType; icon: ReactNode }[] = [
  {
    value: "system",
    icon: (
      <>
        <path
          d="M7.5 8.5C7.5 7.94772 7.94772 7.5 8.5 7.5H19.5C20.0523 7.5 20.5 7.94772 20.5 8.5V16.5C20.5 17.0523 20.0523 17.5 19.5 17.5H8.5C7.94772 17.5 7.5 17.0523 7.5 16.5V8.5Z"
          stroke="currentColor"
        />
        <path
          d="M7.5 8.5C7.5 7.94772 7.94772 7.5 8.5 7.5H19.5C20.0523 7.5 20.5 7.94772 20.5 8.5V14.5C20.5 15.0523 20.0523 15.5 19.5 15.5H8.5C7.94772 15.5 7.5 15.0523 7.5 14.5V8.5Z"
          stroke="currentColor"
        />
        <path
          d="M16.5 20.5V17.5H11.5V20.5M16.5 20.5H11.5M16.5 20.5H17.5M11.5 20.5H10.5"
          stroke="currentColor"
          strokeLinecap="round"
        />
      </>
    ),
  },
  {
    value: "light",
    icon: (
      <>
        <circle cx="14" cy="14" r="3.5" stroke="currentColor" />
        {[
          "M14 8.5V6.5",
          "M17.889 10.1115L19.3032 8.69727",
          "M19.5 14L21.5 14",
          "M17.889 17.8885L19.3032 19.3027",
          "M14 21.5V19.5",
          "M8.69663 19.3029L10.1108 17.8887",
          "M6.5 14L8.5 14",
          "M8.69663 8.69711L10.1108 10.1113",
        ].map((d) => (
          <path key={d} d={d} stroke="currentColor" strokeLinecap="round" />
        ))}
      </>
    ),
  },
  {
    value: "dark",
    icon: (
      <>
        <path
          d="M10.5 9.99914C10.5 14.1413 13.8579 17.4991 18 17.4991C19.0332 17.4991 20.0176 17.2902 20.9132 16.9123C19.7761 19.6075 17.109 21.4991 14 21.4991C9.85786 21.4991 6.5 18.1413 6.5 13.9991C6.5 10.8902 8.39167 8.22304 11.0868 7.08594C10.7089 7.98159 10.5 8.96597 10.5 9.99914Z"
          stroke="currentColor"
          strokeLinejoin="round"
        />
        <path
          d="M16.3561 6.50754L16.5 5.5L16.6439 6.50754C16.7068 6.94752 17.0525 7.29321 17.4925 7.35607L18.5 7.5L17.4925 7.64393C17.0525 7.70679 16.7068 8.05248 16.6439 8.49246L16.5 9.5L16.3561 8.49246C16.2932 8.05248 15.9475 7.70679 15.5075 7.64393L14.5 7.5L15.5075 7.35607C15.9475 7.29321 16.2932 6.94752 16.3561 6.50754Z"
          fill="currentColor"
          stroke="currentColor"
          strokeLinecap="round"
          strokeLinejoin="round"
        />
        <path
          d="M20.3561 11.5075L20.5 10.5L20.6439 11.5075C20.7068 11.9475 21.0525 12.2932 21.4925 12.3561L22.5 12.5L21.4925 12.6439C21.0525 12.7068 20.7068 13.0525 20.6439 13.4925L20.5 14.5L20.3561 13.4925C20.2932 13.0525 19.9475 12.7068 19.5075 12.6439L18.5 12.5L19.5075 12.3561C19.9475 12.2932 20.2932 11.9475 20.3561 11.5075Z"
          fill="currentColor"
          stroke="currentColor"
          strokeLinecap="round"
          strokeLinejoin="round"
        />
      </>
    ),
  },
];

export default function ThemeSwitcher() {
  const [theme, setTheme] = useState<ThemeType>(getTheme);

  useEffect(() => {
    applyTheme(theme);
  }, [theme]);

  return (
    <div
      className="text-white relative z-0 inline-grid grid-cols-3 gap-0.5 rounded-full bg-white/7 p-0.75"
      role="radiogroup"
    >
      {options.map(({ value, icon }) => (
        <label
          key={value}
          className="highlight-focus cursor-pointer rounded-full"
          onKeyDown={(event) => event.key === "Enter" && setTheme(value)}
          tabIndex={0}
        >
          <input
            className="peer sr-only"
            type="radio"
            name="theme"
            value={value}
            onChange={() => setTheme(value)}
            checked={theme === value}
          />
          <span className="peer-checked:text-secondary-500 block rounded-full peer-checked:bg-white peer-checked:ring peer-checked:inset-ring peer-checked:ring-transparent peer-checked:inset-ring-white/10">
            <svg {...iconProps} style={{ width: "1.75rem", fill: "none" }}>
              {icon}
            </svg>
          </span>
        </label>
      ))}
    </div>
  );
}
