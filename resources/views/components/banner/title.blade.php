<section id="banner" class="banner banner-title">
    <figure class="banner-background" style="--banner-image: url({{ asset($image) }})">
        <img src="{{ asset($image) }}" alt="Banner image">
    </figure>

    <main class="banner-body color-white">
        <section>
            <header class="banner-header">
                <h2 class="MontereyFLF">{{ $title }}</h2>
            </header>
            
            <main class="banner-main">
                <p class="Work-Sans text-center">{{ $description }}</p>
            </main>
        </section>
    </main>
</section>