<?php
require_once __DIR__ . '/../lang/Language.php';
$language = Language::getInstance();
$currentLang = $language->getCurrentLang();
?>

<div class="language-selector">
    <form action="/php/lang/change_language.php" method="POST" id="langForm">
        <select name="lang" onchange="this.form.submit()" class="form-control">
            <option value="en" <?php echo $currentLang == 'en' ? 'selected' : ''; ?>>English</option>
            <option value="zh" <?php echo $currentLang == 'zh' ? 'selected' : ''; ?>>中文</option>
        </select>
    </form>
</div>

<style>
.language-selector {
    display: inline-block;
    margin-left: 15px;
}

.language-selector select {
    background-color: transparent;
    border: 1px solid rgba(255,255,255,0.5);
    color: white;
    padding: 5px 10px;
    cursor: pointer;
}

.language-selector select option {
    background-color: #4a4f5d;
    color: white;
}
</style>
