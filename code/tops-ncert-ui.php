<?php
/** TOPS NCERT pages: look, hub cards, chapter test. Only /in/ncert/ pages are touched. */
if (!defined('ABSPATH')) { return; }

function tops_nu_level() {
  $u = (string)parse_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '', PHP_URL_PATH);
  if (!preg_match('#^/in/ncert(/.*)?$#', $u, $m)) return -1;
  $rest = trim(isset($m[1]) ? $m[1] : '', '/');
  return $rest === '' ? 0 : count(explode('/', $rest));
}
add_filter('body_class', function ($c) {
  $l = tops_nu_level();
  if ($l >= 0) { $c[] = 'tn-page'; $c[] = 'tn-l'.$l; }
  return $c;
});
function tops_nu_css() {
  if (tops_nu_level() < 0) return;
  echo '<style id="tops-nu-css">'.tops_nu_css_text().'</style>'."\n";
}
add_action('wp_head', 'tops_nu_css', 30);

function tops_nu_css_text() {
  return <<<'CSS'
.tn-page{--tn-navy:#14213D;--tn-blue:#2147D6;--tn-yellow:#FFD84D;--tn-paper:#F5F7FB;--tn-line:#E1E7F2;--tn-ink:#41506F;--tn-card:#fff;--tn-h:#14213D;--tn-soft:#5B6B8C;--tn-chipbg:#EEF2FF;--tn-chipfg:#2147D6;--tn-hover:#F7F9FF}
html.tops-dark .tn-page,html.tops-dark body.tn-page{--tn-paper:#0E1524;--tn-line:#26314D;--tn-ink:#B3BACC;--tn-card:#161E30;--tn-h:#E8ECF5;--tn-soft:#98A3BD;--tn-chipbg:#1E2A4D;--tn-chipfg:#9DB3FF;--tn-hover:#1B2540}
html body.tn-page .elementor>.e-con:first-child{background:linear-gradient(135deg,#0F1A33 0%,#1B2E63 55%,#2147D6 135%)!important;padding:46px 24px 54px!important;position:relative;overflow:hidden}
html body.tn-page .elementor>.e-con:first-child::before{content:"";position:absolute;right:-90px;top:-90px;width:340px;height:340px;border-radius:50%;background:radial-gradient(circle,rgba(255,216,77,.28),rgba(255,216,77,0) 70%);pointer-events:none}
html body.tn-page .elementor>.e-con:first-child .elementor-heading-title{color:#fff!important;font-size:clamp(26px,4.2vw,38px)!important;line-height:1.2!important;letter-spacing:-.01em;max-width:860px}
html body.tn-page .elementor>.e-con:first-child .elementor-widget-text-editor,html body.tn-page .elementor>.e-con:first-child .elementor-widget-text-editor *{color:#D9E2FF!important;font-size:17px;line-height:1.65}
html body.tn-page .elementor>.e-con:first-child .elementor-widget-text-editor{max-width:820px}
html body.tn-page .tn-crumbs{display:flex;flex-wrap:wrap;gap:6px 8px;align-items:center;font:600 13px Inter,sans-serif;margin:0 0 16px;color:#AFC0F5}
html body.tn-page .tn-crumbs a{color:#CFDAFF!important;text-decoration:none!important}.tn-crumbs a:hover{color:#fff!important;text-decoration:underline!important}
html body.tn-page .tn-crumbs b{color:#fff;font-weight:700}.tn-crumbs i{font-style:normal;opacity:.55}
html body.tn-page .tn-tiles{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:12px;margin-top:22px}
html body.tn-page .tn-tile{display:flex;flex-direction:column;gap:6px;padding:14px 15px;border-radius:14px;background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.22);text-decoration:none!important;color:#fff!important;transition:all .18s}
html body.tn-page .tn-tile:hover{background:#fff;transform:translateY(-3px);box-shadow:0 12px 28px rgba(0,0,0,.25)}
html body.tn-page .tn-tile:hover b,html body.tn-page .tn-tile:hover span{color:#14213D!important}
html body.tn-page .tn-tile svg{width:34px;height:34px;padding:7px;border-radius:10px;background:#FFD84D;color:#14213D;box-sizing:border-box}
html body.tn-page .tn-tile b{font:700 15px "Plus Jakarta Sans",Inter,sans-serif;color:#fff}.tn-tile span{font:500 12.5px Inter,sans-serif;color:#C5D2FA}
html body.tn-page .tn-tile.tn-hot{background:#FFD84D;border-color:#FFD84D}.tn-tile.tn-hot b,.tn-tile.tn-hot span{color:#14213D!important}.tn-tile.tn-hot svg{background:#14213D;color:#FFD84D}
html body.tn-page .elementor>.e-con:nth-child(2){padding-top:30px!important}
html body.tn-page #topics,html body.tn-page #notes,html body.tn-page #solutions,html body.tn-page #important-questions,html body.tn-page #practice-paper,html body.tn-page #chapter-test,html body.tn-page #faq,html body.tn-page #chapters{border:1px solid var(--tn-line)!important;border-radius:20px!important;box-shadow:0 8px 28px rgba(20,33,61,.06);position:relative;overflow:hidden;padding:30px 34px 32px!important;background:var(--tn-card)!important}
html body.tn-page #topics::before,html body.tn-page #notes::before,html body.tn-page #solutions::before,html body.tn-page #important-questions::before,html body.tn-page #practice-paper::before,html body.tn-page #chapter-test::before,html body.tn-page #faq::before,html body.tn-page #chapters::before{content:"";position:absolute;left:0;top:0;bottom:0;width:6px;background:#2147D6}
html body.tn-page #solutions::before{background:#1E9E6A}.tn-page #important-questions::before{background:#E08A00}.tn-page #practice-paper::before{background:#7A4DD8}.tn-page #chapter-test::before{background:#FFD84D}.tn-page #faq::before{background:#14213D}
html body.tn-page #topics .elementor-heading-title,html body.tn-page #notes .elementor-heading-title,html body.tn-page #solutions .elementor-heading-title,html body.tn-page #important-questions .elementor-heading-title,html body.tn-page #practice-paper .elementor-heading-title,html body.tn-page #faq .elementor-heading-title,html body.tn-page #chapters .elementor-heading-title{font-size:25px!important;letter-spacing:-.01em}
html body.tn-page #notes .elementor-widget-text-editor,html body.tn-page #solutions .elementor-widget-text-editor,html body.tn-page #important-questions .elementor-widget-text-editor,html body.tn-page #practice-paper .elementor-widget-text-editor,html body.tn-page #topics .elementor-widget-text-editor,html body.tn-page #faq .elementor-widget-text-editor{color:var(--tn-ink)!important;line-height:1.7}
html body.tn-page #topics ul{list-style:none;padding:0;margin:14px 0 0;display:grid;grid-template-columns:repeat(auto-fit,minmax(290px,1fr));gap:12px}
html body.tn-page #topics li{background:var(--tn-paper);border:1px solid var(--tn-line);border-radius:12px;padding:13px 15px;line-height:1.5;margin:0}
html body.tn-page #topics li strong{display:inline;color:var(--tn-h);font-family:"Plus Jakarta Sans",Inter,sans-serif}
html body.tn-page #notes ul,html body.tn-page #solutions ul,html body.tn-page #important-questions ol{padding-left:22px}
html body.tn-page #notes li,html body.tn-page #solutions li,html body.tn-page #important-questions li{margin:0 0 9px}
html body.tn-page #notes li::marker,html body.tn-page #solutions li::marker,html body.tn-page #important-questions li::marker{color:var(--tn-chipfg);font-weight:700}
html body.tn-page #notes p strong{color:var(--tn-h)}
html body.tn-page .elementor-widget-button .elementor-button{background:linear-gradient(135deg,#2147D6,#3B63F0)!important;color:#fff!important;border-radius:12px!important;padding:14px 26px!important;font:700 15px Inter,sans-serif!important;box-shadow:0 8px 20px rgba(33,71,214,.28);transition:all .18s}
html body.tn-page .elementor-widget-button .elementor-button:hover{background:#14213D!important;transform:translateY(-2px)}
html body.tn-page .elementor-widget-button .elementor-button-text::before{content:"\2193\00a0\00a0";font-weight:800}
html body.tn-page #faq .elementor-widget-text-editor p:nth-child(odd){margin:0;padding-top:16px;margin-top:16px;border-top:1px solid var(--tn-line)}
html body.tn-page #faq .elementor-widget-text-editor p:nth-child(odd):first-child{border-top:0;margin-top:0;padding-top:0}
html body.tn-page #faq p strong{color:var(--tn-h);font-size:16.5px}
html body.tn-page .elementor>.e-con:last-child{background:var(--tn-paper)}
html body.tn-page .elementor>.e-con:last-child a{color:var(--tn-chipfg)!important;font-weight:600}
html body.tn-page .tn-chapters{display:grid;grid-template-columns:repeat(auto-fill,minmax(310px,1fr));gap:14px;margin:16px 0 0;padding:0}
html body.tn-page .tn-ch{display:flex;gap:15px;align-items:center;padding:16px 18px;border:1px solid var(--tn-line);border-radius:14px;background:var(--tn-card);text-decoration:none!important;color:var(--tn-h)!important;transition:all .18s}
html body.tn-page .tn-ch:hover{border-color:var(--tn-chipfg);box-shadow:0 10px 26px rgba(33,71,214,.14);transform:translateY(-2px)}
html body.tn-page .tn-ch .tn-n{flex:0 0 44px;height:44px;border-radius:12px;background:#2147D6;color:#fff;display:grid;place-items:center;font:800 17px "Plus Jakarta Sans",Inter,sans-serif}
html body.tn-page .tn-ch .tn-t{font:700 15.5px/1.3 "Plus Jakarta Sans",Inter,sans-serif;display:block}
html body.tn-page .tn-ch small{display:block;color:var(--tn-soft);font:500 12.5px Inter,sans-serif;margin-top:4px}
html body.tn-page .tn-ch .tn-go{margin-left:auto;color:var(--tn-chipfg);font-weight:800;font-size:18px}
html body.tn-page .tn-cards{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:18px;margin:6px 0 10px}
html body.tn-page .tn-cc{display:flex;flex-direction:column;gap:12px;background:var(--tn-card);border:1px solid var(--tn-line);border-radius:20px;padding:24px;text-decoration:none!important;color:var(--tn-h)!important;position:relative;overflow:hidden;transition:all .2s;box-shadow:0 6px 22px rgba(20,33,61,.05)}
html body.tn-page .tn-cc::after{content:"";position:absolute;right:-30px;top:-30px;width:110px;height:110px;border-radius:50%;background:rgba(33,71,214,.08)}
html body.tn-page .tn-cc:hover{transform:translateY(-4px);border-color:var(--tn-chipfg);box-shadow:0 16px 36px rgba(33,71,214,.16)}
html body.tn-page .tn-cc .tn-big{font:800 30px/1.1 "Plus Jakarta Sans",Inter,sans-serif}.tn-cc .tn-sm{color:var(--tn-soft);font:500 14px/1.5 Inter,sans-serif}
html body.tn-page .tn-chips{display:flex;flex-wrap:wrap;gap:8px}.tn-chips span{background:var(--tn-chipbg);color:var(--tn-chipfg);border-radius:99px;padding:5px 12px;font:700 12.5px Inter,sans-serif}
html body.tn-page .tn-cc .tn-open{margin-top:auto;font:700 14px Inter,sans-serif;color:var(--tn-chipfg)}
html body.tn-page .tn-feats{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;margin:8px 0}
html body.tn-page .tn-feat{background:var(--tn-paper);border:1px solid var(--tn-line);border-radius:16px;padding:20px}
html body.tn-page .tn-feat svg{width:38px;height:38px;padding:8px;border-radius:11px;background:#14213D;color:#FFD84D;box-sizing:border-box}
html body.tn-page .tn-feat b{display:block;margin:10px 0 4px;font:700 16px "Plus Jakarta Sans",Inter,sans-serif;color:var(--tn-h)}.tn-feat span{color:var(--tn-ink);font:400 14px/1.55 Inter,sans-serif}
html body.tn-page .tn-h2{font:800 26px/1.2 "Plus Jakarta Sans",Inter,sans-serif;color:var(--tn-h);margin:26px 0 8px}
html body.tn-page .tn-quiz{font-family:Inter,sans-serif;color:var(--tn-h)}
html body.tn-page .tn-qtitle{display:flex;flex-wrap:wrap;gap:8px 14px;align-items:center;margin-bottom:6px}
html body.tn-page .tn-qtitle h2{margin:0;font:800 25px "Plus Jakarta Sans",Inter,sans-serif;color:var(--tn-h)}
html body.tn-page .tn-qbadge{background:#FFD84D;color:#14213D;border-radius:99px;padding:4px 12px;font:800 11.5px Inter,sans-serif;letter-spacing:.05em}
html body.tn-page .tn-quiz p.tn-lead{margin:0 0 14px;color:var(--tn-ink);line-height:1.65}
html body.tn-page .tn-qmeta{display:flex;flex-wrap:wrap;gap:8px;margin:0 0 16px}.tn-qmeta span{background:var(--tn-chipbg);color:var(--tn-chipfg);border-radius:99px;padding:6px 13px;font:700 12.5px Inter,sans-serif}
html body.tn-page .tn-quiz button{font-family:Inter,sans-serif;box-shadow:none;text-transform:none;letter-spacing:0}
html body.tn-page .tn-b{display:inline-block;background:#2147D6;color:#fff!important;border:0;border-radius:12px;padding:13px 26px;font:700 15px Inter,sans-serif;cursor:pointer;text-decoration:none!important;transition:all .18s;line-height:1.2}
html body.tn-page .tn-b:hover{background:#14213D}.tn-b.tn-y{background:#FFD84D;color:var(--tn-h)!important}.tn-b.tn-y:hover{background:var(--tn-card)}.tn-b[disabled]{opacity:.45;cursor:not-allowed}
html body.tn-page .tn-b.tn-o{background:var(--tn-card);color:var(--tn-chipfg)!important;border:2px solid #2147D6}.tn-b.tn-o:hover{background:var(--tn-chipbg)}
html body.tn-page .tn-qtop{display:flex;justify-content:space-between;align-items:center;font:700 13.5px Inter,sans-serif;color:var(--tn-ink);margin-bottom:8px}.tn-time{background:#14213D;color:#FFD84D;border-radius:99px;padding:4px 12px;font-variant-numeric:tabular-nums}
html body.tn-page .tn-bar{height:8px;background:var(--tn-line);border-radius:99px;overflow:hidden;margin-bottom:18px}.tn-bar i{display:block;height:100%;background:linear-gradient(90deg,#2147D6,#5B7BFF);transition:width .3s}
html body.tn-page .tn-qtext{font:700 19px/1.5 "Plus Jakarta Sans",Inter,sans-serif;margin:0 0 12px}
html body.tn-page .tn-opt{display:flex;gap:12px;align-items:flex-start;width:100%;text-align:left;border:2px solid #DDE3EE;background:var(--tn-card);border-radius:13px;padding:13px 16px;margin:10px 0;font:600 15.5px/1.45 Inter,sans-serif;cursor:pointer;color:var(--tn-h);transition:all .15s}
html body.tn-page .tn-opt:hover{border-color:var(--tn-chipfg);background:var(--tn-hover)}.tn-opt.sel{border-color:var(--tn-chipfg);background:var(--tn-chipbg)}
html body.tn-page .tn-opt em{flex:0 0 26px;height:26px;border-radius:50%;background:var(--tn-line);color:var(--tn-chipfg);display:grid;place-items:center;font:800 13px Inter,sans-serif;font-style:normal}.tn-opt.sel em{background:#2147D6;color:#fff}
html body.tn-page .tn-qnav{display:flex;justify-content:space-between;gap:10px;margin-top:16px}
html body.tn-page .tn-score{display:flex;flex-wrap:wrap;gap:18px;align-items:center;background:var(--tn-paper);border:1px solid var(--tn-line);border-radius:16px;padding:20px 22px;margin-bottom:16px}
html body.tn-page .tn-ring{width:92px;height:92px;border-radius:50%;display:grid;place-items:center;background:conic-gradient(#2147D6 calc(var(--p)*1%),#E1E7F2 0);position:relative}
html body.tn-page .tn-ring::after{content:"";position:absolute;inset:9px;background:#F5F7FB;border-radius:50%}.tn-ring b{position:relative;z-index:1;font:800 24px "Plus Jakarta Sans",Inter,sans-serif}
html body.tn-page .tn-score h3{margin:0 0 4px;font:800 21px "Plus Jakarta Sans",Inter,sans-serif;color:var(--tn-h)}.tn-score p{margin:0;color:var(--tn-ink)}
html body.tn-page .tn-rv{border:1px solid var(--tn-line);border-left:5px solid #D64545;border-radius:12px;padding:13px 16px;margin:10px 0;background:var(--tn-card)}.tn-rv.ok{border-left-color:#1E9E6A}
html body.tn-page .tn-rv b{display:block;margin-bottom:5px;line-height:1.45}.tn-rv p{margin:3px 0;font-size:14.5px;color:var(--tn-ink)}.tn-rv .g{color:#1E9E6A;font-weight:700}.tn-rv .r{color:#D64545;font-weight:700}
html body.tn-page .tn-ctas{margin-top:20px}
html body.tn-page .tn-cta{background:linear-gradient(135deg,#0F1A33,#2147D6);color:#fff;border-radius:18px;padding:26px 28px;position:relative;overflow:hidden}
html body.tn-page .tn-cta h3{margin:0 0 8px;color:#fff;font:800 23px/1.25 "Plus Jakarta Sans",Inter,sans-serif}.tn-cta p{margin:0 0 16px;color:#D9E2FF;line-height:1.6;max-width:640px}
html body.tn-page .tn-cta .tn-lk{color:#FFD84D!important;font-weight:700;margin-left:14px;text-decoration:underline!important}
html body:not(.logged-in) .tn-cta-user{display:none}body.logged-in .tn-cta-guest{display:none}
@media(max-width:640px){html body.tn-page #topics,html body.tn-page #notes,html body.tn-page #solutions,html body.tn-page #important-questions,html body.tn-page #practice-paper,html body.tn-page #chapter-test,html body.tn-page #faq,html body.tn-page #chapters{padding:22px 18px!important}html body.tn-page .tn-tiles{grid-template-columns:repeat(2,1fr)}html body.tn-page .tn-cta{padding:22px 18px}html body.tn-page .tn-cta .tn-lk{display:block;margin:12px 0 0}}
html body.tn-page #notes .elementor-widget-text-editor *,html body.tn-page #solutions .elementor-widget-text-editor *,html body.tn-page #important-questions .elementor-widget-text-editor *,html body.tn-page #practice-paper .elementor-widget-text-editor *,html body.tn-page #topics .elementor-widget-text-editor *,html body.tn-page #faq .elementor-widget-text-editor *{color:var(--tn-ink)!important}
html body.tn-page #notes strong,html body.tn-page #solutions strong,html body.tn-page #important-questions strong,html body.tn-page #topics strong,html body.tn-page #faq strong{color:var(--tn-h)!important}
html body.tn-page .tn-quiz p,html body.tn-page .tn-quiz .tn-rv p{color:var(--tn-ink)}
html body.tn-page .tn-quiz .tn-qtext,html body.tn-page .tn-quiz .tn-rv b,html body.tn-page .tn-opt span{color:var(--tn-h)!important}
html body.tn-page .tn-cta h3{color:#fff!important}html body.tn-page .tn-cta p{color:#D9E2FF!important}
html body.tn-page .tn-tile.tn-hot b,html body.tn-page .tn-tile.tn-hot span{color:#14213D!important}
html body.tn-page .tn-tile:hover b,html body.tn-page .tn-tile:hover span{color:#14213D!important}
html body.tn-page .tn-tile b{color:#fff}html body.tn-page .tn-tile span{color:#C5D2FA}
html body.tn-page .tn-tile.tn-hot b,html body.tn-page .tn-tile.tn-hot span,html body.tn-page .tn-tile:hover b,html body.tn-page .tn-tile:hover span,html body.tn-page .tn-b.tn-y,html body.tn-page .tn-qbadge{-webkit-text-fill-color:#14213D!important}
html body.tn-page .tn-tile.tn-hot svg{color:#FFD84D!important}
html body.tn-page .tn-b,html body.tn-page .tn-cta h3,html body.tn-page .tn-cta p,html body.tn-page .tn-tile b,html body.tn-page .tn-tile span{-webkit-text-fill-color:currentColor}
CSS;
}

/* ---------- small helpers ---------- */
function tops_nu_icon($k) {
  $p = [
    'notes' => '<path d="M5 4h11a3 3 0 0 1 3 3v13H8a3 3 0 0 1-3-3z"/><path d="M8 8h7M8 12h7"/>',
    'sol' => '<circle cx="12" cy="12" r="9"/><path d="m8 12.5 2.8 2.8L16 9.5"/>',
    'imp' => '<path d="m12 3 2.7 5.6 6.1.9-4.4 4.3 1 6.1L12 17l-5.4 2.9 1-6.1L3.2 9.5l6.1-.9z"/>',
    'paper' => '<rect x="5" y="3" width="14" height="18" rx="2"/><path d="M9 8h6M9 12h6M9 16h4"/>',
    'quiz' => '<path d="M4 20l1.2-4.4L16 4.8a2 2 0 0 1 2.8 0l.4.4a2 2 0 0 1 0 2.8L8.4 18.8z"/><path d="m14 7 3 3"/>',
    'free' => '<path d="M12 3v12m0 0 4-4m-4 4-4-4M5 20h14"/>',
  ];
  return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'.$p[$k].'</svg>';
}
function tops_nu_subject_label($slug) { $m = ['evs' => 'EVS', 'maths' => 'Maths', 'science' => 'Science']; return isset($m[$slug]) ? $m[$slug] : ucfirst($slug); }
function tops_nu_children($id) { return get_posts(['post_type' => 'page', 'post_parent' => $id, 'post_status' => 'publish', 'numberposts' => -1, 'orderby' => 'menu_order title', 'order' => 'ASC']); }
function tops_nu_nchap($subject_id) { $n = 0; foreach (tops_nu_children($subject_id) as $c) if (strpos($c->post_name, 'chapter-') === 0) $n++; return $n; }
function tops_nu_crumb_name($p) {
  if ($p->post_name === 'ncert') return 'NCERT';
  if (preg_match('/^class-(\d+)$/', $p->post_name, $m)) return 'Class '.$m[1];
  if ($p->post_parent && preg_match('/^class-\d+$/', get_post_field('post_name', $p->post_parent))) return tops_nu_subject_label($p->post_name);
  return 'Chapter '.(preg_match('/^chapter-(\d+)-/', $p->post_name, $m) ? $m[1] : '');
}

/* ---------- shortcodes ---------- */
add_shortcode('tops_ncert_crumbs', function () {
  $id = get_the_ID();
  $h = '<nav class="tn-crumbs" aria-label="Breadcrumb"><a href="'.esc_url(home_url('/')).'">Home</a>';
  foreach (array_reverse(get_post_ancestors($id)) as $a) {
    $p = get_post($a);
    if (!$p || in_array($p->post_name, ['in'], true) || $p->ID == 1510) continue;
    $h .= '<i>/</i><a href="'.esc_url(get_permalink($p)).'">'.esc_html(tops_nu_crumb_name($p)).'</a>';
  }
  return $h.'<i>/</i><b>'.esc_html(tops_nu_crumb_name(get_post($id))).'</b></nav>';
});
add_shortcode('tops_ncert_tiles', function () {
  $has = get_post_meta(get_the_ID(), '_tops_quiz_pool', true);
  $t = [['#notes', 'notes', 'Short Notes', 'Rules, formulas, tricks'], ['#solutions', 'sol', 'NCERT Solutions', 'Every question solved'], ['#important-questions', 'imp', 'Important Questions', 'With full answers'], ['#practice-paper', 'paper', 'Sample Paper', '30 marks, with key']];
  $h = '<div class="tn-tiles">';
  foreach ($t as $x) $h .= '<a class="tn-tile" href="'.$x[0].'">'.tops_nu_icon($x[1]).'<b>'.$x[2].'</b><span>'.$x[3].'</span></a>';
  $h .= '<a class="tn-tile tn-hot" href="#chapter-test">'.tops_nu_icon('quiz').'<b>Chapter Test</b><span>5 quick questions</span></a>';
  return $h.'</div>';
});
add_shortcode('tops_ncert_cards', function () {
  $id = get_the_ID(); $lvl = tops_nu_level(); $kids = tops_nu_children($id); $h = '<div class="tn-cards">';
  if ($lvl === 0) {
    usort($kids, function ($a, $b) { return (int)substr($a->post_name, 6) - (int)substr($b->post_name, 6); });
    foreach ($kids as $c) {
      if (!preg_match('/^class-(\d+)$/', $c->post_name, $m)) continue;
      $chips = ''; $tot = 0;
      foreach (tops_nu_children($c->ID) as $s) { $n = tops_nu_nchap($s->ID); if (!$n) continue; $tot += $n; $chips .= '<span>'.esc_html(tops_nu_subject_label($s->post_name)).' · '.$n.'</span>'; }
      if (!$tot) continue;
      $h .= '<a class="tn-cc" href="'.esc_url(get_permalink($c)).'"><span class="tn-big">Class '.$m[1].'</span><span class="tn-chips">'.$chips.'</span><span class="tn-sm">'.$tot.' chapters with notes, solutions, important questions, sample papers and a chapter test.</span><span class="tn-open">Open Class '.$m[1].' →</span></a>';
    }
  } else {
    foreach ($kids as $s) {
      $n = tops_nu_nchap($s->ID); if (!$n) continue;
      $book = preg_match('/\(([^)]+)\)/', $s->post_title, $bm) ? $bm[1] : 'NCERT';
      $h .= '<a class="tn-cc" href="'.esc_url(get_permalink($s)).'"><span class="tn-big">'.esc_html(tops_nu_subject_label($s->post_name)).'</span><span class="tn-chips"><span>'.$n.' chapters</span><span>'.esc_html($book).'</span></span><span class="tn-sm">Short notes, NCERT solutions, important questions, sample paper and a 5-question test for every chapter.</span><span class="tn-open">See all chapters →</span></a>';
    }
  }
  return $h.'</div>';
});
add_shortcode('tops_ncert_features', function () {
  $f = [['notes', 'Short Notes', 'Simple, complete notes with formulas, memory tricks and common mistakes.'], ['sol', 'NCERT Solutions', 'Every in-text, activity and exercise question answered in clear steps.'], ['imp', 'Important Questions', 'Exam-style 1, 2, 3 and 5 mark questions with full solutions.'], ['paper', 'Sample Paper', 'A 30-mark, 1-hour paper with answer key and marking scheme.'], ['quiz', 'Chapter Test', 'A quick 5-question test on every chapter page. Get your score instantly.'], ['free', 'Free PDFs', 'Download everything free. Register free to learn the full chapter course.']];
  $h = '<div class="tn-feats">';
  foreach ($f as $x) $h .= '<div class="tn-feat">'.tops_nu_icon($x[0]).'<b>'.$x[1].'</b><span>'.$x[2].'</span></div>';
  return $h.'</div>';
});

/* ---------- chapter test ---------- */
add_shortcode('tops_chapter_quiz', function () {
  $id = get_the_ID();
  $pool = get_post_meta($id, '_tops_quiz_pool', true);
  $course = (int)get_post_meta($id, '_tops_quiz_course', true);
  $curl = $course ? get_permalink($course) : home_url('/dashboard/');
  $signup = home_url('/signup/'); $login = home_url('/login/');
  $cta = '<div class="tn-cta tn-cta-guest"><h3>Register for free and learn this full chapter for free</h3><p>Join The One Page School at no cost and get the complete chapter course: topic-wise lessons, tests after every topic and your own progress tracking.</p><a class="tn-b tn-y" href="'.esc_url($signup).'">Register free</a><a class="tn-lk" href="'.esc_url($login).'">Already registered? Log in</a></div>';
  $cta .= '<div class="tn-cta tn-cta-user"><h3>Keep going: learn this full chapter</h3><p>Your chapter course is ready, with topic-wise lessons and tests. Pick up from where this test ended.</p><a class="tn-b tn-y" href="'.esc_url($curl).'">Go to the chapter course →</a></div>';
  $h = '<div class="tn-quiz" id="tn-quiz"><div class="tn-qtitle"><h2>Chapter Test</h2><span class="tn-qbadge">FREE</span></div>';
  if (!is_array($pool) || count($pool) < 5) {
    return $h.'<p class="tn-lead">Done with the notes? Learn this whole chapter step by step in the free chapter course.</p><div class="tn-ctas">'.$cta.'</div></div>';
  }
  $h .= '<p class="tn-lead">Five quick questions to check how well you know this chapter. You get your score and the correct answers at the end.</p>';
  $h .= '<div class="tn-qmeta"><span>5 questions</span><span>5 minutes</span><span>Instant score</span></div>';
  $h .= '<div class="tn-qb" data-pool="'.esc_attr(wp_json_encode($pool, JSON_UNESCAPED_UNICODE)).'"><button type="button" class="tn-b tn-start">Start the test</button></div>';
  $h .= '<div class="tn-ctas" style="display:none">'.$cta.'</div></div>';
  return $h;
});
function tops_nu_js() {
  if (tops_nu_level() !== 3) return;
  $id = get_queried_object_id();
  if (!is_array(get_post_meta($id, '_tops_quiz_pool', true))) return;
  echo '<script id="tops-nu-js">'.tops_nu_js_text().'</script>'."\n";
}
add_action('wp_footer', 'tops_nu_js', 50);
function tops_nu_js_text() {
  return <<<'JS'
(function(){
var root=document.getElementById('tn-quiz');if(!root)return;
var qb=root.querySelector('.tn-qb'),ctas=root.querySelector('.tn-ctas'),pool=[];
try{pool=JSON.parse(qb.getAttribute('data-pool'))||[];}catch(e){}
var L=['A','B','C','D','E','F'],set,idx,ans,left,timer;
function shuffle(a){a=a.slice();for(var i=a.length-1;i>0;i--){var j=Math.floor(Math.random()*(i+1));var t=a[i];a[i]=a[j];a[j]=t;}return a;}
function pick(){var by={easy:[],moderate:[],hard:[]};pool.forEach(function(q){(by[q.d]||by.moderate).push(q);});var out=[];[['easy',2],['moderate',2],['hard',1]].forEach(function(x){out=out.concat(shuffle(by[x[0]]).slice(0,x[1]));});if(out.length<5){var rest=shuffle(pool.filter(function(q){return out.indexOf(q)<0;}));out=out.concat(rest.slice(0,5-out.length));}return shuffle(out).slice(0,5);}
function fmt(s){s=Math.max(0,s);return Math.floor(s/60)+':'+('0'+(s%60)).slice(-2);}
function esc(s){var d=document.createElement('div');d.textContent=s;return d.innerHTML;}
function start(){set=pick();idx=0;ans=[];left=300;ctas.style.display='none';clearInterval(timer);timer=setInterval(function(){left--;var t=qb.querySelector('.tn-time');if(t)t.textContent=fmt(left);if(left<=0)finish();},1000);show();}
function show(){var q=set[idx],h='<div class="tn-qtop"><span>Question '+(idx+1)+' of 5</span><span class="tn-time">'+fmt(left)+'</span></div><div class="tn-bar"><i style="width:'+(idx/5*100)+'%"></i></div><p class="tn-qtext">'+q.q+'</p>';
q.o.forEach(function(o,i){h+='<button type="button" class="tn-opt'+(ans[idx]===i?' sel':'')+'" data-i="'+i+'"><em>'+L[i]+'</em><span>'+o+'</span></button>';});
h+='<div class="tn-qnav"><button type="button" class="tn-b tn-o tn-prev"'+(idx?'':' disabled')+'>Back</button><button type="button" class="tn-b tn-next"'+(ans[idx]===undefined?' disabled':'')+'>'+(idx===4?'Submit test':'Next')+'</button></div>';
qb.innerHTML=h;
Array.prototype.forEach.call(qb.querySelectorAll('.tn-opt'),function(b){b.onclick=function(){ans[idx]=+b.getAttribute('data-i');show();};});
qb.querySelector('.tn-prev').onclick=function(){if(idx){idx--;show();}};
qb.querySelector('.tn-next').onclick=function(){if(idx===4)finish();else{idx++;show();}};}
function finish(){clearInterval(timer);var sc=0,rv='';set.forEach(function(q,i){var ok=ans[i]===q.a;if(ok)sc++;rv+='<div class="tn-rv'+(ok?' ok':'')+'"><b>Q'+(i+1)+'. '+q.q+'</b><p>Your answer: <span class="'+(ok?'g':'r')+'">'+(ans[i]===undefined?'Not answered':q.o[ans[i]])+'</span></p>'+(ok?'':'<p>Correct answer: <span class="g">'+q.o[q.a]+'</span></p>')+(q.e?'<p>'+q.e+'</p>':'')+'</div>';});
var msg=sc>=4?'Excellent! You know this chapter well.':sc>=3?'Good effort! A little more practice and you will master it.':'Keep going! Read the notes and try again.';
qb.innerHTML='<div class="tn-score"><div class="tn-ring" style="--p:'+(sc/5*100)+'"><b>'+sc+'/5</b></div><div><h3>You scored '+sc+' out of 5</h3><p>'+msg+'</p></div></div>'+rv+'<div class="tn-qnav"><button type="button" class="tn-b tn-o tn-again">Try again with new questions</button></div>';
qb.querySelector('.tn-again').onclick=start;ctas.style.display='block';root.scrollIntoView({behavior:'smooth',block:'start'});}
qb.querySelector('.tn-start').onclick=start;
})();
JS;
}

/* ---------- build the 15-question pool from the chapter's Chapter Test quiz ---------- */
function tops_nu_clean($s) { return trim((string)wp_kses(trim((string)$s), ['sub' => [], 'sup' => [], 'b' => [], 'strong' => [], 'i' => [], 'em' => []])); }
function tops_nu_pool($quiz_id, $seed) {
  $qq = get_post_meta($quiz_id, 'vibe_quiz_questions', true);
  $ids = (is_array($qq) && isset($qq['ques'])) ? $qq['ques'] : [];
  mt_srand((int)$seed); shuffle($ids); mt_srand();
  $by = ['easy' => [], 'moderate' => [], 'hard' => []]; $tf = 0;
  foreach ($ids as $qid) {
    $t = get_post_meta($qid, 'vibe_question_type', true);
    if ($t !== 'single' && $t !== 'truefalse') continue;
    $p = get_post($qid); if (!$p) continue;
    $raw = $p->post_content.' '.$p->post_title;
    if (preg_match('/<img|\[latex|\\\\\(|\\\\\[|\[audio|\[video|\bfigure\b|\bdiagram\b|shown below|given below|picture|table/i', $raw)) continue;
    $opts = get_post_meta($qid, 'vibe_question_options', true);
    if (!is_array($opts) || count($opts) < 2 || count($opts) > 5) continue;
    $ans = get_post_meta($qid, 'vibe_question_answer', true);
    if (!preg_match('/^\d+$/', (string)$ans)) continue;
    $o = array_values(array_map('tops_nu_clean', $opts));
    $bad = false; foreach ($o as $x) if ($x === '' || strlen($x) > 160) $bad = true;
    if ($bad) continue;
    if ($t === 'truefalse') { if ($tf >= 3) continue; $correct = ((int)$ans === 1) ? 0 : 1; $o = ['True', 'False']; $tf++; }
    else { $correct = (int)$ans - 1; }
    if ($correct < 0 || $correct >= count($o)) continue;
    $q = tops_nu_clean($p->post_content); if ($q === '') $q = tops_nu_clean($p->post_title);
    if ($q === '' || strlen($q) > 320) continue;
    $d = get_post_meta($qid, 'tops_difficulty', true); if (!isset($by[$d])) $d = 'moderate';
    $e = tops_nu_clean(get_post_meta($qid, 'vibe_question_explaination', true)); if (strlen($e) > 300) $e = '';
    $by[$d][] = ['q' => $q, 'o' => $o, 'a' => $correct, 'e' => $e, 'd' => $d];
  }
  $pool = array_merge(array_slice($by['easy'], 0, 5), array_slice($by['moderate'], 0, 5), array_slice($by['hard'], 0, 4));
  return $pool;
}
function tops_nu_find_quiz($cls, $subj, $num) {
  global $wpdb;
  $pre = ['maths' => 'm', 'science' => 's', 'evs' => 's'][strtolower($subj)];
  $cid = (int)$wpdb->get_var($wpdb->prepare("SELECT pm.post_id FROM {$wpdb->postmeta} pm JOIN {$wpdb->posts} p ON p.ID=pm.post_id AND p.post_type='course' AND p.post_status='publish' WHERE pm.meta_key IN ('_tops_sci_id','_tops_map_id') AND pm.meta_value=%s LIMIT 1", $pre.$cls.'_'.$num));
  if (!$cid) return [0, 0];
  $q = (int)$wpdb->get_var($wpdb->prepare("SELECT p.ID FROM {$wpdb->posts} p JOIN {$wpdb->postmeta} pm ON pm.post_id=p.ID AND pm.meta_key='vibe_quiz_course' AND pm.meta_value=%s WHERE p.post_type='quiz' AND p.post_status='publish' AND p.post_title LIKE 'Chapter Test%%' LIMIT 1", $cid));
  return [$cid, $q];
}
function tops_nu_attach($pid, $cls, $subj, $num) {
  list($cid, $qid) = tops_nu_find_quiz($cls, $subj, $num);
  if ($cid) update_post_meta($pid, '_tops_quiz_course', $cid);
  if ($qid) {
    $pool = tops_nu_pool($qid, $pid);
    if (count($pool) >= 5) { update_post_meta($pid, '_tops_quiz_pool', $pool); return 'pool '.count($pool); }
    return 'pool too small '.count($pool);
  }
  return $cid ? 'no quiz' : 'no course';
}
/** Add crumbs, tiles and the quiz card to a chapter page (safe to repeat). */
function tops_nu_migrate_chapter($pid) {
  $raw = get_post_meta($pid, '_elementor_data', true); if (!$raw) return 'no data';
  if (strpos($raw, 'tops_chapter_quiz') !== false) return 'already';
  $d = json_decode($raw, true); if (!is_array($d) || count($d) < 2) return 'bad data';
  $els = $d[0]['elements']; $new = [tops_cp_w('shortcode', ['shortcode' => '[tops_ncert_crumbs]'])];
  foreach ($els as $w) {
    if (($w['widgetType'] ?? '') === 'text-editor' && strpos($w['settings']['editor'] ?? '', 'Jump to:') !== false) { $new[] = tops_cp_w('shortcode', ['shortcode' => '[tops_ncert_tiles]']); continue; }
    $new[] = $w;
  }
  $d[0]['elements'] = $new;
  $wrap = $d[1]['elements']; $out = []; $done = false;
  foreach ($wrap as $c) {
    $out[] = $c;
    if (!$done && ($c['settings']['_element_id'] ?? '') === 'practice-paper') { $out[] = tops_cp_card([tops_cp_w('shortcode', ['shortcode' => '[tops_chapter_quiz]'])], 'chapter-test'); $done = true; }
  }
  if (!$done) return 'no paper card';
  $d[1]['elements'] = $out;
  tops_cp_save_elementor($pid, $d);
  return 'migrated';
}
