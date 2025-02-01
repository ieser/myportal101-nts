
<!doctype html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="/img/logos/logo.svg">
        <!--<link rel="manifest" href="manifest.json">-->

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
        <link rel="stylesheet" type="text/css" href="/css/general.css" /> 
        <link rel="stylesheet" type="text/css" href="/css/font.css">
        <link rel="stylesheet" type="text/css" href="/css/sidebar.css">
        
        <?php foreach($page->css as $csssrc){ ?> 
            <link rel="stylesheet" type="text/css" href="/assets/<?=$cssrc;?>">
        <?php } ?>
    </head>
    <body data-bs-theme="<?=$page->theme;?>">
        <div class="container-fluid min-vh-100">
            <div class="row">
                <nav class="sticky-top sidebar bg-body ps-3 pe-0" id="sidebar">
                    <span class="d-none" id="sidebar-active"><?=$page->sidebar;?></span>
                    <div class="d-flex flex-column vh-100">
                        <div class="d-flex justify-content-center px-2 py-3">
                            <a href="/" class="">
                                <img src="/img/logos/logo.svg" class="logo m-auto my-2" alt="NTS MyPortal">
                            </a>
                        </div>
                        <ul class="nav nav-pills flex-column mb-auto p-2" >
                            <li class="nav-item" id="sidebar-dashboard" data-section="dashboard" >
                                <a class="nav-link" href="/dashboard">
                                    <i class="fa-solid fa-home"></i>
                                    <span class="nav-voice">Home</span>
                                </a>
                            </li>
                            <hr>
                        
                            <li class="nav-item" id="sidebar-moulds" data-section="moulds" style="display:">
                                <a class="nav-link" href="/moulds">
                                    <i class="fa-solid fa-industry"></i>
                                    <span class="nav-voice">Stampi</span>
                                </a>
                            </li>
                            <hr>
                            <li class="nav-item" id="sidebar-users" data-section="users" style="display:">
                                <a class="nav-link" href="/users">
                                    <i class="fa-solid fa-user"></i>
                                    <span class="nav-voice">Utenti</span>
                                </a>
                            </li>
                            <li class="nav-item" id="sidebar-groups" data-section="groups" style="display:">
                                <a class="nav-link" href="/groups">
                                    <i class="fa-solid fa-user-group"></i>
                                    <span class="nav-voice">Gruppi</span>
                                </a>
                            </li>
                        
                            <li class="nav-item" id="sidebar-privileges" data-section="privileges" style="display:">
                                <a class="nav-link" href="/privileges">
                                    <i class="fa-solid fa-user-shield"></i>
                                    <span class="nav-voice">Privilegi</span>
                                </a>
                            </li>
                            <hr>
                            
                            <li class="nav-item" id="sidebar-logs" data-section="logs" style="display:">
                                <a class="nav-link" href="/logs">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <span class="nav-voice">Log</span>
                                </a>
                            </li>
                            <li class="nav-item" id="sidebar-settings" data-section="settings" style="display:">
                                <a class="nav-link" href="/settings">
                                    <i class="fa-solid fa-gears"></i>
                                    <span class="nav-voice">Impostazioni</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="col d-flex flex-column vh-100">
                    <header class="bg-body container-fluid p-3 ">
                        <div class="row">
                            <div class="col d-flex align-items-center">
                                <?php if (!empty($goback)) { ?>
                                    <a class="btn btn-primary text-start px-3 py-2 me-2" href="<?=$goback;?>"><i class="fa-solid fa-backward-step me-0"></i></a>
                                <?php } ?>  
                                <i class="fa-solid fa-caret-left" id="sidebarTrigger"></i>
                                <div class="position-relative w-100 mx-3">
                                    <div class="input-group ">
                                        <div class="input-group-prepend input-group-text"><i class="fas fa-search py-1"></i></div>
                                        <input type='text' class="form-control bg-body" id="search-section" placeholder="Ricerca sezioni">
                                    </div>

                                    <div class="list-group position-absolute w-100" id="search-section-list" style="display:none;z-index:1000;">
                                        <?php if(isset($backendsections) and is_array($backendsections)){?>
                                            <?php foreach($backendsections as $s){?>
                                                <a href="<?=$s["link"];?>" class="list-group-item list-group-item-action border-bottom d-flex align-items-center gap-2 py-2" >
                                                    <div class="d-flex flex-column">
                                                        <span class="d-none"><?=$s["tips"];?></span>
                                                        <h6 class="my-1"> <i class="fa-solid <?=$s["icon"];?> me-2"></i><?=$s["name"];?></h6>
                                                        <p class="mb-1"><?=$s["synthesis"];?></p>
                                                    </div>
                                                </a>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-2 me-3 rounded-1 ms-auto" data-bs-toggle="offcanvas" data-bs-target="#notification" aria-expanded="false">
                                        <i class="fa-solid fa-bell mx-1"></i>
                                    </button>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0 me-3 rounded-1 overflow-hidden ms-auto" data-bs-toggle="dropdown" data-bs-target="#user-menu" aria-expanded="false">
                                        <img src="" class="img-fluid" style="width:50px;" id="profile-picture">
                                    </button>
                                    <ul class="dropdown-menu" id="user-menu">
                                        <li>
                                            <a class="text-decoration-none text-body d-block py-2 px-4" href="/account">
                                                <i class="fa-solid fa-id-badge"></i>
                                                <span class="nav-voice">Account</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-decoration-none text-body d-block py-2 px-4" href="/appearance">
                                                <i class="fa-solid fa-palette"></i>
                                                <span class="nav-voice">Aspetto</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="text-decoration-none text-body d-block py-2 px-4" href="/logout">
                                                <i class="fa-solid fa-right-from-bracket"></i>
                                                <span class="nav-voice">Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </header> 
                    <main class="bg-body-tertiary flex-fill rounded overflow-scroll p-2">
                        <div class="container-fluid bg-body-tertiary p-3 p-xl-4">
                            <div class="row">
                                <div class="col-12 col-md-8 pb-2">
                                    <h4><?=$page->title;?></h4>
                                    <?php if(isset($page->breadcrumbs) AND is_array($page->breadcrumbs)){ ?> 
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb breadcrumb-chevron ">
                                                <li class="breadcrumb-item"><a href="/dashboard"><i class="fa-solid fa-house"></i></a></li>
                                                <?php foreach($page->breadcrumbs as $title => $link){ ?>
                                                    <li class="breadcrumb-item"><a href="<?=$link;?>"><?=$title;?></a></li>
                                                <?php } ?>
                                            </ol>
                                        </nav>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col py-2" id="main-content"></div>
                            </div>
                        </div>
                    </main> 
                    <footer></footer>
                    </div>
                </div>
                <div class="col" style="width:20px;">
                </div>
            </div>
        </div>
        <div class="modal" id="confirm-modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Conferma</h5>
                    </div>
                    <div class="modal-body">
                        <p id="confirm-modal-message">Confermi l'operazione?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="confirm-modal-no"  class="btn btn-secondary">Annulla</button>
                        <button type="button" id="confirm-modal-yes" class="btn btn-yellow" >Continua</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="notification" >
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Notifiche</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div>Nessuna notifica presente</div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/efb28107df.js" crossorigin="anonymous"></script>
        
        <script src="/js/functions.js"></script>
        <script src="/assets/core/reserved-core.js"></script>
        <script src="/assets/core/reserved-confirm-dialog.js"></script>
        <script src="/assets/core/reserved-sidebar.js"></script>
        <script src="/assets/core/reserved-searchbar.js"></script>
        <?php foreach($page->js as $jssrc){ ?> 
            <script src="/assets/<?=$jssrc;?>"></script>
        <?php } ?>
    </body>
</html>