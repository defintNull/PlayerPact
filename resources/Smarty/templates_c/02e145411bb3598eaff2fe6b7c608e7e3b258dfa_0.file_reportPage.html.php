<?php
/* Smarty version 5.1.0, created on 2024-06-17 17:03:31
  from 'file:reportPage.html' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.1.0',
  'unifunc' => 'content_6670504304b175_34703014',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02e145411bb3598eaff2fe6b7c608e7e3b258dfa' => 
    array (
      0 => 'reportPage.html',
      1 => 1718632697,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6670504304b175_34703014 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Lorenzo\\Desktop\\PlayerPact\\resources\\Smarty\\templates';
?><html>
	<head>
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
			crossorigin="anonymous"
		/>
		<?php echo '<script'; ?>

			src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
			crossorigin="anonymous"
		><?php echo '</script'; ?>
>

		<link rel="stylesheet" href="/resources/css/report.css" />
	</head>
	<body>
		<div class="title-report-section">
			<a>Report sending</a>
		</div>
		<form class="form-body" action="/post/confirmReport" method="post">
			<div class="reportDescription">
				<div class="input-group mb-3">
					<input
						type="text"
						name="description"
						class="form-control"
						placeholder="Tell us the reason..."
						aria-describedby="inputGroup-sizing-default"
					/>
				</div>
			</div>
			<input type="hidden" name="objToReportId" value="<?php echo $_smarty_tpl->getValue('objToReportId');?>
" class="form-control" aria-describedby="inputGroup-sizing-default" />
			<input
				type="hidden"
				name="objToReportType"
				value="<?php echo $_smarty_tpl->getValue('objToReportType');?>
"
				class="form-control"
				aria-describedby="inputGroup-sizing-default"
			/>
			<div>
				<button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn confirmReportButton">Report</button>
			</div>
		</form>
	</body>
</html>
<?php }
}
