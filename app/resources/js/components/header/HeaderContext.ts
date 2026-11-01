import { createContext, useContext } from "react";

type HeaderContextValue = {
  currentLocation?: string;
  navigationIsOpen: boolean;
  toggleNavigation: (open?: boolean) => void;
};

export const HeaderContext = createContext<HeaderContextValue>({
  navigationIsOpen: false,
  toggleNavigation: () => {},
});

export const useHeader = () => useContext(HeaderContext);
