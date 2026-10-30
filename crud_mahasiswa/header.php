<!DOCTYPE html>
<html lang="<?= e($lang) ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e(t('title')) ?></title>
<style>
 body{font-family:Arial,sans-serif;background:#f4f6f8;margin:0;color:#222}
 .wrap{max-width:900px;margin:30px auto;background:#fff;padding:24px;border-radius:8px;box-shadow:0 2px 8px #0001}
 nav{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px}
 table{width:100%;border-collapse:collapse;margin-top:12px}
 th,td{border:1px solid #ddd;padding:8px;text-align:left}
 th{background:#2c3e50;color:#fff}
 input,select{width:100%;padding:8px;margin:4px 0 12px;box-sizing:border-box}
 .btn{display:inline-block;padding:7px 14px;background:#2980b9;color:#fff;border:0;border-radius:4px;text-decoration:none;cursor:pointer;font-size:14px;width:auto}
 .btn.red{background:#c0392b}.btn.gray{background:#7f8c8d}
 .err{background:#fdecea;color:#b71c1c;padding:8px 12px;border-radius:4px;margin-bottom:12px}
 .ok{background:#e8f5e9;color:#1b5e20;padding:8px 12px;border-radius:4px;margin-bottom:12px}
 form.inline{display:inline}
</style>
</head>
<body><div class="wrap">
<nav>
 <strong><?= e(t('title')) ?></strong>
 <span>
  <a href="set_lang.php?lang=id">ID</a> | <a href="set_lang.php?lang=en">EN</a>
  <?php if (!empty($_SESSION['user'])): ?>
   | <?= e(t('welcome')) ?>, <?= e($_SESSION['user']) ?> | <a href="logout.php"><?= e(t('logout')) ?></a>
  <?php endif; ?>
 </span>
</nav>
