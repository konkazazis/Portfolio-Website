<x-layouts.app title="Privacy Policy · Kostas Kazazis">
    <x-site-header />

    <main>
        {{-- Header --}}
        <section class="pt-[clamp(40px,6vw,80px)] pb-[clamp(20px,3vw,36px)]">
            <div class="doc-wrap">
                <span class="reveal eyebrow">Legal</span>
                <h1 class="reveal mt-4 font-bold text-[clamp(2.1rem,5vw,3.2rem)] leading-[1.05] tracking-[-0.03em]" data-d="1">Privacy Policy</h1>
                <p class="reveal mt-4 font-mono text-[12.5px] text-muted" data-d="2">Datenschutzerklärung · Last updated: {{ now()->format('F Y') }}</p>
            </div>
        </section>

        {{-- Body --}}
        <section class="pb-[clamp(56px,8vw,104px)]">
            <div class="doc-wrap">
                <div class="prose-kk reveal">
                    <p>Your privacy matters. This page explains what personal data is collected when you visit <a href="{{ url('/') }}">kazazis.dev</a>, why, and the rights you have over it under the EU General Data Protection Regulation (GDPR / DSGVO).</p>

                    <h2>1. Who is responsible</h2>
                    <p>The controller responsible for data processing on this website is:</p>
                    <div class="legal-card not-prose">
                        <p style="margin:0; color:var(--color-ink); font-weight:600;">Kostas Kazazis</p>
                        <p style="margin:0.3em 0 0;">[Address — see Impressum]<br>Düsseldorf, Germany<br><a href="mailto:hello@kazazis.dev">hello@kazazis.dev</a></p>
                    </div>

                    <h2>2. Data collected when you visit</h2>
                    <p>When you load this site, my hosting provider automatically records standard server log data for security and operational reasons. This typically includes:</p>
                    <ul>
                        <li>your anonymised IP address,</li>
                        <li>the date and time of the request,</li>
                        <li>the page or file requested,</li>
                        <li>your browser type and operating system, and</li>
                        <li>the referring page.</li>
                    </ul>
                    <p>This data is processed on the basis of my legitimate interest in operating a secure, functioning website (Art. 6 (1)(f) GDPR) and is not combined with other data or used to identify you.</p>

                    <h2>3. The contact form</h2>
                    <p>If you send a message through the contact form, the name, email address and message you provide are transmitted to me so I can respond. This processing is based on your consent and on taking steps at your request prior to entering a contract (Art. 6 (1)(a) and (b) GDPR). I keep these messages only as long as needed to handle your enquiry, after which they are deleted.</p>

                    <h2>4. Hosting</h2>
                    <p>This website is hosted by a third-party provider who processes the server data described above strictly on my behalf under a data-processing agreement (Art. 28 GDPR). [Name your hosting provider here, e.g. Hetzner, Railway, AWS.]</p>

                    <h2>5. Cookies &amp; analytics</h2>
                    <p>This site uses only the technically necessary cookies required for it to function. No advertising or third-party tracking cookies are set. [If you later add analytics such as Plausible or Google Analytics, describe it here and add a consent banner.]</p>

                    <h2>6. Your rights</h2>
                    <p>Under the GDPR you have the right to:</p>
                    <ul>
                        <li>request access to the personal data held about you,</li>
                        <li>have inaccurate data corrected,</li>
                        <li>have your data erased,</li>
                        <li>restrict or object to processing,</li>
                        <li>receive your data in a portable format, and</li>
                        <li>lodge a complaint with a supervisory authority.</li>
                    </ul>
                    <p>To exercise any of these rights, simply email <a href="mailto:hello@kazazis.dev">hello@kazazis.dev</a>.</p>

                    <h2>7. Changes to this policy</h2>
                    <p>I may update this policy as the site evolves or the law changes. The date at the top of this page always reflects the most recent revision.</p>
                    <hr>
                    <p>For the legally required provider details, see the <a href="{{ url('/impressum') }}">Impressum</a>.</p>
                </div>
            </div>
        </section>
    </main>

    <x-site-footer />
</x-layouts.app>
