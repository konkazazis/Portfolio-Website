@extends('layouts.master')

@php $lang = request('lang') === 'en' ? 'en' : 'de'; @endphp

@section('title', 'Datenschutz')
@section('meta_description', 'Datenschutzerklärung für kostas.dev gemäß DSGVO.')
@section('canonical', route('privacy', $lang === 'en' ? ['lang' => 'en'] : []))

@push('head')
    <link rel="alternate" hreflang="de" href="{{ route('privacy') }}">
    <link rel="alternate" hreflang="en" href="{{ route('privacy', ['lang' => 'en']) }}">
    <link rel="alternate" hreflang="x-default" href="{{ route('privacy') }}">
@endpush

@section('content')
    <div class="max-w-2xl my-8 mx-6 lg:mx-auto">

        <div class="mb-10 pb-6 border-b border-stone-200 flex items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold tracking-tight uppercase mb-2">
                    Daten<strong class="text-brand">schutz</strong>
                </h1>
                <p class="text-stone-400 text-sm">
                    {{ $lang === 'en' ? 'Privacy Policy — in accordance with GDPR' : 'Datenschutzerklärung gemäß DSGVO' }}
                </p>
            </div>
            <div class="flex gap-1 shrink-0">
                <a href="{{ route('privacy') }}"
                    class="px-3 py-1 rounded text-xs font-medium tracking-wide transition-colors
                                          {{ $lang === 'de' ? 'bg-stone-800 text-white' : 'text-stone-500 border border-stone-200 hover:border-stone-400 hover:text-stone-700' }}">
                    DE
                </a>
                <a href="{{ route('privacy', ['lang' => 'en']) }}"
                    class="px-3 py-1 rounded text-xs font-medium tracking-wide transition-colors
                                          {{ $lang === 'en' ? 'bg-stone-800 text-white' : 'text-stone-500 border border-stone-200 hover:border-stone-400 hover:text-stone-700' }}">
                    EN
                </a>
            </div>
        </div>

        <div class="prose prose-stone max-w-none text-stone-700 leading-relaxed space-y-8">

            @if($lang === 'de')

                <section>
                    <h2 class="text-lg font-bold text-stone-800 mb-2">1. Verantwortlicher</h2>
                    <p>
                        Konstantinos Kazazis<br>
                        Oberratherstrassse 24<br>
                        40472, Düsseldorf<br>
                        Deutschland<br>
                        E-Mail:
                        <a href="mailto:kostas@kazazis.dev" class="text-brand hover:underline">
                            kostas@kazazis.dev
                        </a>
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-stone-800 mb-2">2. Hosting</h2>
                    <p>
                        Diese Website wird bei <strong>[HOSTING-ANBIETER: BITTE ERGÄNZEN — Name und Anschrift]</strong>
                        gehostet. Beim Besuch der Website verarbeitet der Hosting-Anbieter automatisch technische
                        Informationen (Server-Logfiles), die Ihr Browser übermittelt, z. B. IP-Adresse, Datum und
                        Uhrzeit der Anfrage, Browsertyp und -version, verwendetes Betriebssystem sowie die zuvor
                        besuchte Seite (Referrer-URL). Diese Daten dienen ausschließlich der Gewährleistung eines
                        störungsfreien und sicheren Betriebs der Website und werden nicht mit anderen Datenquellen
                        zusammengeführt.
                    </p>
                    <p class="mt-2">
                        Rechtsgrundlage: Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse an einem technisch
                        fehlerfreien und sicheren Betrieb der Website).
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-stone-800 mb-2">3. Cookies & Session</h2>
                    <p>
                        Diese Website setzt technisch notwendige Cookies ein, um den Betrieb der Website
                        zu gewährleisten (z. B. Session-Cookie für CSRF-Schutz). Diese Cookies enthalten
                        keine personenbezogenen Daten und werden nach dem Schließen des Browsers gelöscht.
                        Tracking- oder Werbe-Cookies werden nicht eingesetzt.
                    </p>
                    <p class="mt-2">
                        Rechtsgrundlage: Art. 6 Abs. 1 lit. f DSGVO (technische Notwendigkeit).
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-stone-800 mb-2">4. Kontaktformular</h2>
                    <p>
                        Wenn Sie das Kontaktformular auf dieser Website nutzen, verarbeiten wir die von Ihnen
                        eingegebenen Daten (Name, E-Mail-Adresse, Betreff, Nachricht), um Ihre Anfrage zu
                        bearbeiten und zu beantworten. Die Daten werden in einer Datenbank gespeichert und sind
                        ausschließlich für den Websitebetreiber einsehbar; eine Weitergabe an Dritte findet nicht statt.
                    </p>
                    <p class="mt-2">
                        Die Angaben werden gespeichert, bis der Zweck Ihrer Anfrage erfüllt ist bzw. bis Sie die
                        Löschung verlangen. Gesetzliche Aufbewahrungspflichten bleiben unberührt.
                    </p>
                    <p class="mt-2">
                        Rechtsgrundlage: Art. 6 Abs. 1 lit. b DSGVO (Bearbeitung Ihrer Anfrage) bzw.
                        Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse an der Beantwortung von Anfragen).
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-stone-800 mb-2">5. Eingebundene Bilder</h2>
                    <p>
                        Zur Darstellung von Profil- und Beitragsbildern bindet diese Website Bilddateien ein, die
                        von einem Clouflare ausgeliefert werden. Beim Laden dieser Bilder
                        wird Ihre IP-Adresse an Cloudflare übermittelt.
                    </p>
                    <p class="mt-2">
                        Alle Schriftarten und Icon-Bibliotheken dieser Website werden selbst gehostet; insoweit
                        findet keine Datenübertragung an Dritte statt.
                    </p>
                    <p class="mt-2">
                        Rechtsgrundlage: Art. 6 Abs. 1 lit. f DSGVO (berechtigtes Interesse an einer performanten
                        Auslieferung von Inhalten).
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-stone-800 mb-2">6. Ihre Rechte</h2>
                    <p>Ihnen stehen nach der DSGVO folgende Rechte gegenüber dem Verantwortlichen zu:</p>
                    <ul class="list-disc pl-6 mt-2 space-y-1">
                        <li>Recht auf Auskunft (Art. 15 DSGVO)</li>
                        <li>Recht auf Berichtigung (Art. 16 DSGVO)</li>
                        <li>Recht auf Löschung (Art. 17 DSGVO)</li>
                        <li>Recht auf Einschränkung der Verarbeitung (Art. 18 DSGVO)</li>
                        <li>Recht auf Datenübertragbarkeit (Art. 20 DSGVO)</li>
                        <li>Recht auf Widerspruch gegen die Verarbeitung (Art. 21 DSGVO)</li>
                    </ul>
                    <p class="mt-2">
                        Zur Ausübung dieser Rechte genügt eine formlose Mitteilung an die oben genannte
                        E-Mail-Adresse.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-stone-800 mb-2">7. Beschwerderecht</h2>
                    <p>
                        Sie haben das Recht, sich bei einer Datenschutz-Aufsichtsbehörde über die Verarbeitung
                        Ihrer personenbezogenen Daten zu beschweren. Zuständige Aufsichtsbehörde für den
                        Verantwortlichen ist:
                    </p>
                    <p class="mt-2">
                        Landesbeauftragte für Datenschutz und Informationsfreiheit Nordrhein-Westfalen (LDI NRW)<br>
                        Kavalleriestraße 2–4, 40213 Düsseldorf<br>
                        <a href="https://www.ldi.nrw.de" target="_blank" rel="noopener noreferrer"
                            class="text-brand hover:underline">www.ldi.nrw.de</a>
                    </p>
                </section>

            @else

                <section>
                    <h2 class="text-lg font-bold text-stone-800 mb-2">1. Data Controller</h2>
                    <p>
                        Konstantinos Kazazis<br>
                        Oberratherstrassse 24<br>
                        40472, Düsseldorf<br>
                        Germany<br>
                        Email:
                        <a href="mailto:kostas@kazazis.dev" class="text-brand hover:underline">
                            kostas@kazazis.dev
                        </a>
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-stone-800 mb-2">2. Hosting</h2>
                    <p>
                        This website is hosted by <strong>[HOSTING PROVIDER: PLEASE FILL IN — name and address]</strong>.
                        When you visit the site, the hosting provider automatically processes technical
                        information transmitted by your browser (server log files), such as IP address, date
                        and time of the request, browser type and version, operating system, and the
                        previously visited page (referrer URL). This data is used solely to ensure reliable
                        and secure operation of the website and is not combined with other data sources.
                    </p>
                    <p class="mt-2">
                        Legal basis: Art. 6(1)(f) GDPR (legitimate interest in technically error-free and
                        secure operation of the website).
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-stone-800 mb-2">3. Cookies & Session</h2>
                    <p>
                        This website uses technically necessary cookies to ensure its operation
                        (e.g. a session cookie for CSRF protection). These cookies contain no personal
                        data and are deleted when the browser is closed. No tracking or advertising
                        cookies are used.
                    </p>
                    <p class="mt-2">
                        Legal basis: Art. 6(1)(f) GDPR (legitimate interest in secure website operation).
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-stone-800 mb-2">4. Contact Form</h2>
                    <p>
                        If you use the contact form on this website, we process the data you enter (name,
                        email address, subject, message) to handle and respond to your inquiry. The data is
                        stored in a database and is accessible only to the website operator; it is not shared
                        with third parties.
                    </p>
                    <p class="mt-2">
                        The data is retained until the purpose of your inquiry has been fulfilled or until
                        you request its deletion. Statutory retention obligations remain unaffected.
                    </p>
                    <p class="mt-2">
                        Legal basis: Art. 6(1)(b) GDPR (handling your request) and/or Art. 6(1)(f) GDPR
                        (legitimate interest in responding to inquiries).
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-stone-800 mb-2">5. Embedded Images</h2>
                    <p>
                        To display profile and post images, this website embeds image files served from an
                        Cloudflare storage bucket . Loading these images transmits your
                        IP address to Cloudflare.
                    </p>
                    <p class="mt-2">
                        All fonts and icon libraries used on this website are self-hosted; no data is
                        transmitted to third parties in connection with them.
                    </p>
                    <p class="mt-2">
                        Legal basis: Art. 6(1)(f) GDPR (legitimate interest in performant content delivery).
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-stone-800 mb-2">6. Your Rights</h2>
                    <p>Under the GDPR, you have the following rights against the controller:</p>
                    <ul class="list-disc pl-6 mt-2 space-y-1">
                        <li>Right of access (Art. 15 GDPR)</li>
                        <li>Right to rectification (Art. 16 GDPR)</li>
                        <li>Right to erasure (Art. 17 GDPR)</li>
                        <li>Right to restriction of processing (Art. 18 GDPR)</li>
                        <li>Right to data portability (Art. 20 GDPR)</li>
                        <li>Right to object to processing (Art. 21 GDPR)</li>
                    </ul>
                    <p class="mt-2">
                        To exercise these rights, an informal message to the email address above is
                        sufficient.
                    </p>
                </section>

                <section>
                    <h2 class="text-lg font-bold text-stone-800 mb-2">7. Right to Lodge a Complaint</h2>
                    <p>
                        You have the right to lodge a complaint with a data protection supervisory authority
                        regarding the processing of your personal data. The supervisory authority responsible
                        for the controller is:
                    </p>
                    <p class="mt-2">
                        Landesbeauftragte für Datenschutz und Informationsfreiheit Nordrhein-Westfalen (LDI NRW)<br>
                        Kavalleriestraße 2–4, 40213 Düsseldorf, Germany<br>
                        <a href="https://www.ldi.nrw.de" target="_blank" rel="noopener noreferrer"
                            class="text-brand hover:underline">www.ldi.nrw.de</a>
                    </p>
                </section>

            @endif

        </div>

    </div>
@endsection