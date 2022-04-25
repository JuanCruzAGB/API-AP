<section class="footer-widgets">
    <main class="grid">
        @component('components.footer.top_bar')@endcomponent
        
        @component('components.footer.query', [
            'property' => $property,
        ])@endcomponent
    </main>
</section>

@component('components.footer.copyright')@endcomponent