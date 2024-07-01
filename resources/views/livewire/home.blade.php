<div class="container m-32">
    <form wire:submit="send">
        {{ $this->form }}

        <button
            class="mt-6 select-none rounded-lg border border-gray-900 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            type="submit">
            Send Mail
        </button>
    </form>

    <x-filament-actions::modals />
</div>
