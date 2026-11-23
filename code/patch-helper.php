<?php
$f = WP_CONTENT_DIR.'/novamira-sandbox/tops-chapter-page.php';
$src = file_get_contents($f);
if (strpos($src, 'tops_nu_attach') !== false) return 'already patched';
$P = [];
// a) hero: crumbs + tiles
$P[] = ["  \$hero = tops_cp_hero(\$h1, '<p>'.tops_cp_esc(!empty(\$p['intro']) ? \$p['intro'] : \$excerpt).'</p>', [tops_cp_t(\$jump)]);\n",
"  \$hero = tops_cp_hero(\$h1, '<p>'.tops_cp_esc(!empty(\$p['intro']) ? \$p['intro'] : \$excerpt).'</p>', [tops_cp_t(\$jump)]);\n  if (function_exists('tops_nu_attach')) { \$hero['elements'] = array_merge([tops_cp_w('shortcode', ['shortcode' => '[tops_ncert_crumbs]'])], array_slice(\$hero['elements'], 0, 2), [tops_cp_w('shortcode', ['shortcode' => '[tops_ncert_tiles]'])]); }\n"];
// b) quiz card
$P[] = ["  \$wrap = tops_cp_c(array_merge(\$cards, [\$notes, \$sol, \$imp, \$pap], \$faq), tops_cp_pad(24, 16, 0, 16), 1100);",
"  \$qz = function_exists('tops_nu_attach') ? [tops_cp_card([tops_cp_w('shortcode', ['shortcode' => '[tops_chapter_quiz]'])], 'chapter-test')] : [];\n  \$wrap = tops_cp_c(array_merge(\$cards, [\$notes, \$sol, \$imp, \$pap], \$qz, \$faq), tops_cp_pad(24, 16, 0, 16), 1100);"];
// c) attach the quiz pool after the page is saved
$P[] = ["  tops_cp_save_elementor(\$pid, tops_cp_build_chapter(\$p, \$dl, \$class_id, \$hub_id));\n",
"  tops_cp_save_elementor(\$pid, tops_cp_build_chapter(\$p, \$dl, \$class_id, \$hub_id));\n  if (function_exists('tops_nu_attach')) { \$res['quiz'] = tops_nu_attach(\$pid, \$cls, \$subj, \$num); }\n"];
// d) chapter grid
$P[] = ["function tops_cp_class_list_html(\$class_id) {\n", "function tops_cp_class_list_html(\$class_id) {\n  if (function_exists('tops_nu_chapter_grid')) return tops_nu_chapter_grid(\$class_id);\n"];
// e) subject page: crumbs + anchor
$P[] = ["  \$data = [tops_cp_hero(\$title, '<p>Chapter-wise PDFs for Class '.\$p['cls'].' '.\$p['subject'].': short notes, step-by-step NCERT solutions, important questions with answers and a 30-mark sample paper for every chapter.</p>'),\n    tops_cp_c([tops_cp_card([tops_cp_h('Chapters', 'h2', 26), tops_cp_t('<ol></ol>')])], tops_cp_pad(24, 16, 0, 16), 1100),",
"  \$hero0 = tops_cp_hero(\$title, '<p>Chapter-wise PDFs for Class '.\$p['cls'].' '.\$p['subject'].': short notes, step-by-step NCERT solutions, important questions with answers, a 30-mark sample paper and a 5-question chapter test for every chapter.</p>');\n  if (function_exists('tops_nu_crumbs_widget')) array_unshift(\$hero0['elements'], tops_nu_crumbs_widget());\n  \$data = [\$hero0,\n    tops_cp_c([tops_cp_card([tops_cp_h('Chapters', 'h2', 26), tops_cp_t('<ol></ol>')], 'chapters')], tops_cp_pad(24, 16, 0, 16), 1100),"];
// f) hubs
$P[] = ["  \$class_id = tops_cp_ensure_class(\$hub_id, \$p);\n", "  \$class_id = tops_cp_ensure_class(\$hub_id, \$p);\n  if (function_exists('tops_nu_hub_build')) { tops_nu_hub_build(\$ncert_id); tops_nu_hub_build(\$hub_id); }\n"];
// g) do not append plain links to the shortcode-driven hubs
$P[] = ["  if (!\$post) return 'missing page';\n", "  if (!\$post) return 'missing page';\n  if (strpos((string)get_post_meta(\$post_id, '_elementor_data', true), 'tops_ncert_cards') !== false) return 'ok';\n"];
$bad = [];
foreach ($P as $i => $pp) { if (substr_count($src, $pp[0]) !== 1) { $bad[] = $i.':'.substr_count($src, $pp[0]); continue; } $src = str_replace($pp[0], $pp[1], $src); }
if ($bad) return ['no match' => $bad];
try { token_get_all($src, TOKEN_PARSE); } catch (Throwable $e) { return 'parse '.$e->getMessage(); }
copy($f, $f.'.bak-pre-ui'); copy(substr($f, 0, -4).'.txt', substr($f, 0, -4).'.txt.bak-pre-ui');
file_put_contents($f, $src); @file_put_contents(substr($f, 0, -4).'.txt', $src);
return 'patched '.count($P);
