<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo  $this->language; ?>" lang="<?php echo  $this->language; ?>" dir="<?php echo  $this->direction; ?>" >
<head>
<jdoc:include type="head" />

<link href="templates/<?php echo  $this->template ?>/css/general.css" rel="stylesheet" type="text/css" />
<link href="templates/<?php echo  $this->template ?>/css/component.css" rel="stylesheet" type="text/css" />

<?php if($this->direction == 'rtl') : ?>
	<link href="templates/<?php echo  $this->template ?>/css/general_rtl.css" rel="stylesheet" type="text/css" />
	<link href="templates/<?php echo  $this->template ?>/css/component_rtl.css" rel="stylesheet" type="text/css" />
<?php endif; ?>

</head>
<body class="contentpane">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>