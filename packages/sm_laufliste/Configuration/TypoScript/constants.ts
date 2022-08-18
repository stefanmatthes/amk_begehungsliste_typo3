
plugin.tx_smlaufliste_laufliste {
    view {
        # cat=plugin.tx_smlaufliste_laufliste/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:sm_laufliste/Resources/Private/Templates/
        # cat=plugin.tx_smlaufliste_laufliste/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:sm_laufliste/Resources/Private/Partials/
        # cat=plugin.tx_smlaufliste_laufliste/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:sm_laufliste/Resources/Private/Layouts/
    }
    persistence {
        # cat=plugin.tx_smlaufliste_laufliste//a; type=string; label=Default storage PID
        storagePid =
    }
}
