<x-navbar.item>
    <x-navbar.link
        label="{{ __('Seo Tool') }}"
        href="dashboard.user.seo.index"
        icon="tabler-seo"
        active-condition="{{ route('dashboard.user.seo.index') === url()->current() }}"
    />
</x-navbar.item>
