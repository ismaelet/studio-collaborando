import type { ComponentType, SVGProps } from "react";
import TextBlock from "@/components/typography/TextBlock";
import ThemeSwitcher from "@/components/footer/ThemeSwitcher";
import EmailIcon from "@icons/Email";
import logo from "@images/logo-256.webp";
import styles from "./Footer.module.css";

type Link = {
  name: string;
  route: string;
  icon?: ComponentType<SVGProps<SVGSVGElement>>;
};

type Column = {
  title: string;
  links: Link[];
};

const columns: Column[] = [
  {
    title: "Navigation",
    links: [
      { name: "Zeitleiste", route: "timeline" },
      { name: "Inhalt", route: "documents" },
      { name: "Konditionen", route: "konditionen" },
      { name: "Suche", route: "search" },
    ],
  },
  {
    title: "Rechtliche Hinweise",
    links: [
      { name: "Datenschutzerklärung", route: "datenschutzerklärung" },
      { name: "Cookie-Einstellungen", route: "cookie-settings" },
      { name: "Impressum", route: "impressum" },
    ],
  },
  {
    title: "Kontakt",
    links: [
      {
        name: "example@email.com",
        route: "mailto:example@email.com",
        icon: EmailIcon,
      },
    ],
  },
];

export default function Footer() {
  return (
    <footer className="content-grid bg-secondary-700 border-secondary-300 border-t-4 text-white/50 dark:bg-background-300 dark:border-border-400">
      <div className="breakout w-full items-center lg:py-20 py-12 lg:flex">
        {/* Info */}
        <div className="border-secondary-500 grid lg:h-full grid-cols-1 content-start gap-8 lg:border-r lg:py-4 lg:pr-12 dark:border-border-400 border-b lg:border-b-0 pb-12">
          <div className="grid grid-cols-[max-content_minmax(0,1fr)] items-center gap-4">
            <a href="/">
              <img src={logo} alt="Logo" className="w-14 shrink-0" />
            </a>

            <div>
              <p className="font-heading text-primary-200 text-2xl font-medium">Michael Ende</p>
              <p className=" text-sm uppercase">Die Unendliche Geschichte</p>
            </div>
          </div>

          <TextBlock>
            Lorem ipsum dolor sit amet consectetur adipiscing elit Ut et massa mi. Aliquam in
            hendrerit urna.
          </TextBlock>
        </div>

        {/* Columns */}
        <div className="columns flex w-full grow flex-wrap justify-between gap-16 lg:pl-12 lg:pt-0 pt-12">
          {columns.map((column, index) => (
            <div className="column" key={index}>
              <h3
                className={`${styles.columnName} font-heading text-white border-secondary-400 w-fit border-b dark:border-border-400`}
              >
                {column.title}
              </h3>
              <ul className="grid grid-cols-1 gap-3">
                {column.links.map((link, linkIndex) => (
                  <li key={linkIndex} className="flex w-fit items-center text-lg">
                    {link.icon && (
                      <a href={link.route}>
                        <link.icon
                          className="text-secondary-400 hover:text-secondary-300 mr-2 inline-block h-5 max-w-5 shrink-0 transition-colors dark:text-secondary-300 dark:hover:text-secondary-400"
                          aria-label={`Kontakt über ${link.name}`}
                        />
                      </a>
                    )}
                    <a href={link.route} className="hover:text-white transition-colors">
                      {link.name}
                    </a>
                  </li>
                ))}
              </ul>
            </div>
          ))}
        </div>
      </div>

      <div className="bottom bg-secondary-800 dark:bg-background-400 fill-width px-8 py-5 text-center">
        <p className="mb-2">Copyright © 2026 Michael Ende</p>
        <ThemeSwitcher />
      </div>
    </footer>
  );
}
