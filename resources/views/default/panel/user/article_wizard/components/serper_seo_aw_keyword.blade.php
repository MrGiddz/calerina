@if (setting('serper_seo_aw_keyword', 0) == 1)
    <x-forms.input
            class:container="grow"
            class:custom-wrap="size-7"
            id="use_seo_aw_keyword"
            container-class="w-full topic group-[:not([data-step='0'])]/article-wizard:hidden"
            name="use_seo_aw_keyword"
            type="checkbox"
            label="{{ __('Support SEO for keywords') }}"
            custom
    />
@endif