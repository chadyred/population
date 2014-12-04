<?php $routeName = sfContext::getInstance()->getRouting()->getCurrentInternalUri(false)?>

<?php
    if(strpos($routeName, '?') !== false)
        $routeName .= "&";
    else
        $routeName .= "?";
?>

<!-- Affichage de l'image premiere page -->
<?php if ($pager->getPage() != 1) { ?>
<a href="<?php echo url_for($routeName .'page=1') ?>" ><img src="/images/boutons/navfirst20.png" alt="Première page" onMouseOver="this.src='/images/boutons/navfirst20red.png'" onMouseOut="this.src='/images/boutons/navfirst20.png'"/></a>
<?php } else { ?>
    <img src="/images/boutons/navfirst20.png" alt="Première page" onMouseOver="this.src='/images/boutons/navfirst20red.png'" onMouseOut="this.src='/images/boutons/navfirst20.png'"/>
<?php } ?>
<!-- Affichage de l'image page précédente -->
<?php if ($pager->getPage() != 1) { ?>
    <a href="<?php echo url_for($routeName.'page='.$pager->getPreviousPage())?>" ><img src="/images/boutons/navprev20.png" alt="Page précédente" onMouseOver="this.src='/images/boutons/navprev20red.png'" onMouseOut="this.src='/images/boutons/navprev20.png'"/></a>
<?php } else { ?>
    <img src="/images/boutons/navprev20.png" alt="Page précédente" onMouseOver="this.src='/images/boutons/navprev20red.png'" onMouseOut="this.src='/images/boutons/navprev20.png'"/>
<?php } ?>

<?php foreach($pager->getLinks(10) as $link) { ?>
    <?php if ($link == $pager->getPage()) { ?>
        <p id="current"><?php echo $link ?></p>
    <?php } else { ?>
        <a href="<?php echo url_for($routeName.'page='.$link)?>" ><?php echo $link ?></a>
    <?php } ?>
<?php } ?>

<!-- Affichage de l'image page suivante -->
<?php if ($pager->getPage() == $pager->getLastPage()) { ?>
    <img src="/images/boutons/navnext20.png" alt="Page suivante" onMouseOver="this.src='/images/boutons/navnext20red.png'" onMouseOut="this.src='/images/boutons/navnext20.png'"/>
    <img src="/images/boutons/navlast20.png" alt="Dernière page" onMouseOver="this.src='/images/boutons/navlast20red.png'" onMouseOut="this.src='/images/boutons/navlast20.png'"/>
<?php } else { ?>
    <a href="<?php echo url_for($routeName.'page='.$pager->getNextPage())?>" ><img src="/images/boutons/navnext20.png" alt="Page suivante" onMouseOver="this.src='/images/boutons/navnext20red.png'" onMouseOut="this.src='/images/boutons/navnext20.png'"/></a>
    <a href="<?php echo url_for($routeName.'page='.$pager->getLastPage())?>" ><img src="/images/boutons/navlast20.png" alt="Dernière page" onMouseOver="this.src='/images/boutons/navlast20red.png'" onMouseOut="this.src='/images/boutons/navlast20.png'"/></a>
<?php } ?>