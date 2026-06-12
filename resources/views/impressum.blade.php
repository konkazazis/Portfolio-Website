<x-layouts.app title="Impressum · Kostas Kazazis">
    <x-site-header />

    <main>
        {{-- Header --}}
        <section class="pt-[clamp(40px,6vw,80px)] pb-[clamp(20px,3vw,36px)]">
            <div class="doc-wrap">
                <span class="reveal eyebrow">Legal</span>
                <h1 class="reveal mt-4 font-bold text-[clamp(2.1rem,5vw,3.2rem)] leading-[1.05] tracking-[-0.03em]" data-d="1">Impressum</h1>
                <p class="reveal mt-4 font-mono text-[12.5px] text-muted" data-d="2">Angaben gemäß § 5 TMG</p>
            </div>
        </section>

        {{-- Body --}}
        <section class="pb-[clamp(56px,8vw,104px)]">
            <div class="doc-wrap">
                <div class="prose-kk reveal">
                    <div class="legal-card not-prose">
                        <p style="margin:0; color:var(--color-ink); font-weight:600;">Kostas Kazazis</p>
                        <p style="margin:0.3em 0 0;">[Straße und Hausnummer]<br>[PLZ] Düsseldorf<br>Deutschland</p>
                    </div>

                    <h2>Kontakt</h2>
                    <ul>
                        <li><strong>E-Mail:</strong> <a href="mailto:hello@kazazis.dev">hello@kazazis.dev</a></li>
                        <li><strong>Telefon:</strong> [optional — Telefonnummer]</li>
                        <li><strong>Web:</strong> <a href="{{ url('/') }}">kazazis.dev</a></li>
                    </ul>

                    <h2>Umsatzsteuer-ID</h2>
                    <p>Umsatzsteuer-Identifikationsnummer gemäß § 27 a Umsatzsteuergesetz:<br>[USt-IdNr., falls vorhanden — andernfalls diesen Abschnitt entfernen]</p>

                    <h2>Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV</h2>
                    <p>Kostas Kazazis<br>[Anschrift wie oben]</p>

                    <h2>Streitschlichtung</h2>
                    <p>Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit: <a href="https://ec.europa.eu/consumers/odr" target="_blank" rel="noopener">https://ec.europa.eu/consumers/odr</a>. Meine E-Mail-Adresse finden Sie oben im Impressum.</p>
                    <p>Ich bin nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.</p>

                    <h2>Haftung für Inhalte</h2>
                    <p>Als Diensteanbieter bin ich gemäß § 7 Abs. 1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG bin ich als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen.</p>

                    <h2>Haftung für Links</h2>
                    <p>Mein Angebot enthält Links zu externen Websites Dritter, auf deren Inhalte ich keinen Einfluss habe. Deshalb kann ich für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich.</p>

                    <h2>Urheberrecht</h2>
                    <p>Die durch den Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Beiträge Dritter sind als solche gekennzeichnet. Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet.</p>
                </div>
            </div>
        </section>
    </main>

    <x-site-footer />
</x-layouts.app>
