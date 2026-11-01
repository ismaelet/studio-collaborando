export type NavigationLink = {
  label: string;
  route: string;
  locationTag: string;
};

export type HeaderContextValue = {
  readonly currentLocation?: string;
  readonly navigationIsOpen: boolean;
  toggleNavigation: (open?: boolean) => void;
};

export const HEADER_CONTEXT = Symbol("header-context");
