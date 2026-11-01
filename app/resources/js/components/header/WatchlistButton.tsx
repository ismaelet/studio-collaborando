import WatchlistIcon from "@icons/Watchlist";
import WatchlistFullIcon from "@icons/WatchlistFull";

export default function WatchlistButton() {
  return (
    <button
      className="hover:text-primary-300 stack-content group grid cursor-pointer transition-colors text-heading-400"
      title="Merkliste"
    >
      <WatchlistIcon className="h-5 w-5 transition-opacity group-hover:opacity-0" />
      <WatchlistFullIcon className="h-5 w-5 opacity-0 transition-opacity group-hover:opacity-100" />
    </button>
  );
}
