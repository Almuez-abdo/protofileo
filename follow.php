<?php
    ob_start();
    session_start();

    $pageTitle  = "Website Cost Calculator";
    $current_page = basename($_SERVER['PHP_SELF']);
     include "includes/func/function.php";
     include "includes/config.php";
     include "includes/header.php";
     include "includes/nav.php";

// Stateless pricing: same rates as before, computed from a single POST.
$PRICES = ['landing' => 100, 'company' => 300, 'store' => 800, 'blog' => 250];
$total = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['site_type'])) {
    $total = 0;
    $st = $_POST['site_type'];
    if (isset($PRICES[$st])) { $total += $PRICES[$st]; }
    $total += max(1, (int)($_POST['pages'] ?? 1)) * 50;
    if (($_POST['admin_panel'] ?? '') === 'yes') { $total += 200; }
    if (($_POST['hosting'] ?? '') === 'yes') { $total += 100; }
    if (($_POST['dataBes'] ?? '') === 'yes') { $total += 100; }
    if (($_POST['desing'] ?? '') === 'no') { $total += 100; }
}

?>
    <div id="part" class="pf-wrap">
    <div class="pf-card follow-card">
        <span class="pf-kicker">Free estimate</span>
        <h1>Website Cost Calculator</h1>
        <p class="pf-sub" style="margin-bottom:10px">Answer a few questions to get an instant ballpark estimate.</p>

        <?php if ($total === null): ?>
        <form method="POST" id="calcForm" style="display: grid" novalidate>
            <div class="calc-step" data-step="1">
                <label class="lableQ" style="display: grid" for="site_type">1. نوع الموقع المطلوب :
                <select class="optionQ" name="site_type" id="site_type" required>
                    <option value="">اختر...</option>
                    <option value="landing">صفحة هبوط (Landing Page)</option>
                    <option value="company">موقع شركة</option>
                    <option value="store">متجر إلكتروني</option>
                    <option value="blog">مدونة</option>
                </select>
                </label>
                <button class="buttonQ" type="button" data-next>التالي</button>
            </div>
            <div class="calc-step" data-step="2" hidden>
                <label class="lableQ" style="display: grid" for="pages">2. عدد الصفحات المطلوبة:</label>
                <input class="optionQ" type="number" name="pages" id="pages" value="1" min="1" required>
                <div><button class="buttonQ" type="button" data-back>رجوع</button>
                <button class="buttonQ" type="button" data-next>التالي</button></div>
            </div>
            <div class="calc-step" data-step="3" hidden>
                <label class="lableQ" style="display: grid">3. هل تحتاج الي لوحة تحكم؟</label>
                <div class="choose"><span>نعم</span><input class="optionQ" type="radio" name="admin_panel" value="yes" required></div>
                <div class="choose"><span>لا</span><input class="optionQ" type="radio" name="admin_panel" value="no"></div>
                <div><button class="buttonQ" type="button" data-back>رجوع</button>
                <button class="buttonQ" type="button" data-next>التالي</button></div>
            </div>
            <div class="calc-step" data-step="4" hidden>
                <label class="lableQ" style="display: grid">4. هل تحتاج الي قاعدة بيانات؟</label>
                <div class="choose"><span>نعم</span><input class="optionQ" type="radio" name="dataBes" value="yes" required></div>
                <div class="choose"><span>لا</span><input class="optionQ" type="radio" name="dataBes" value="no"></div>
                <div><button class="buttonQ" type="button" data-back>رجوع</button>
                <button class="buttonQ" type="button" data-next>التالي</button></div>
            </div>
            <div class="calc-step" data-step="5" hidden>
                <label class="lableQ" style="display: grid">5. هل تحتاج استضافة ودومين؟</label>
                <div class="choose"><span>نعم</span><input class="optionQ" type="radio" name="hosting" value="yes" required></div>
                <div class="choose"><span>لا</span><input class="optionQ" type="radio" name="hosting" value="no"></div>
                <div><button class="buttonQ" type="button" data-back>رجوع</button>
                <button class="buttonQ" type="button" data-next>التالي</button></div>
            </div>
            <div class="calc-step" data-step="6" hidden>
                <label class="lableQ" style="display: grid">6. هل لديك تصميم جاهز؟</label>
                <div class="choose"><span>نعم</span><input class="optionQ" type="radio" name="desing" value="yes" required></div>
                <div class="choose"><span>لا</span><input class="optionQ" type="radio" name="desing" value="no"></div>
                <div><button class="buttonQ" type="button" data-back>رجوع</button>
                <button class="buttonQ" type="submit">احسب التكلفة</button></div>
            </div>
        </form>
        <script>
        (function () {
            var steps = Array.prototype.slice.call(document.querySelectorAll('#calcForm .calc-step'));
            var i = 0;
            function show(n) {
                i = Math.max(0, Math.min(steps.length - 1, n));
                steps.forEach(function (s, k) { s.hidden = (k !== i); });
                var t = document.getElementById('part');
                if (t && t.scrollIntoView) { t.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
            }
            function valid() {
                var inputs = steps[i].querySelectorAll('select, input');
                for (var k = 0; k < inputs.length; k++) {
                    var el = inputs[k];
                    if (el.type === 'radio') {
                        var name = el.name;
                        if (!document.querySelector('input[name="' + name + '"]:checked')) { return false; }
                    } else if (!el.value) { el.focus(); return false; }
                }
                return true;
            }
            document.querySelectorAll('#calcForm [data-next]').forEach(function (b) {
                b.addEventListener('click', function () { if (valid()) { show(i + 1); } });
            });
            document.querySelectorAll('#calcForm [data-back]').forEach(function (b) {
                b.addEventListener('click', function () { show(i - 1); });
            });
            show(0);
        })();
        </script>
        <?php else: ?>
            <div class="result">إجمالي التكلفة التقديرية: <strong><?php echo (int)$total; ?> دولار</strong></div>
            <form method="GET"><button class="buttonQ" type="submit">إعادة الحساب</button></form>
        <?php endif; ?>
    </div>
    </div>

    <script>
        var target = document.getElementById('part');
        if (target && target.scrollIntoView) {
            target.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    </script>

<?php
    include "includes/footer.php";

    ob_end_flush();
?>
