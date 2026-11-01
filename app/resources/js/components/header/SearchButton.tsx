import { useRef, useState, type FocusEvent } from "react";
import SearchIcon from "@icons/Search";

export default function SearchButton({ className }: { className?: string }) {
  const [searching, setSearching] = useState(false);
  const searchInput = useRef<HTMLInputElement>(null);

  function toggleSearch() {
    if (searching) {
      setSearching(false);
      searchInput.current?.blur();
    } else {
      setSearching(true);
      searchInput.current?.focus();
    }
  }

  function closeSearch() {
    setSearching(false);
    searchInput.current?.blur();
  }

  function onFocusOut(event: FocusEvent<HTMLFormElement>) {
    if (!event.currentTarget.contains(event.relatedTarget as Node | null)) {
      closeSearch();
    }
  }

  return (
    <form
      method="GET"
      action="/search"
      className={`header-search group grid w-full max-w-80 grid-cols-[max-content_0fr] transition-all has-[input:focus]:grid-cols-[max-content_1fr] md:grid-cols-[0fr_max-content] md:justify-end md:has-[input:focus]:grid-cols-[1fr_max-content] ${className ?? ""}`}
      autoComplete="off"
      onBlur={onFocusOut}
    >
      {/* Search button */}
      <button
        type="button"
        className="hover:text-primary-300 border-border-400 row-start-1 aspect-square w-12 cursor-pointer rounded-lg border transition-all group-has-[input:focus]:rounded-br-none md:col-start-2 md:group-has-[input:focus]:rounded-br-lg md:group-has-[input:focus]:rounded-bl-none text-heading-400"
        onClick={toggleSearch}
        title="Suche"
      >
        <SearchIcon className="m-auto h-5 w-5" aria-hidden="true" focusable="false" />

        <span className="visually-hidden">Suchleiste öffnen</span>
      </button>

      {/* Search input */}
      <label className="overflow-hidden">
        <input
          ref={searchInput}
          type="search"
          name="search"
          className="header-search-input border-border-400 h-full w-full rounded-none border-b bg-transparent px-2 text-lg transition-all outline-none"
          placeholder="Suche..."
        />

        <span className="visually-hidden">Suche</span>
      </label>
    </form>
  );
}
