const CACHE_NAME = 'MSW';
const toCache = [
    '/',
    // 'assets/webarch/css/black_steel.css',
    // 'assets/webarch/css/black-blue.css',
    // 'assets/webarch/css/black-white.css',
    // 'assets/webarch/css/black.css',
    // 'assets/webarch/css/black_scooter.css',
    // 'assets/webarch/css/blue_sea.css',
    // 'assets/webarch/css/blue.css',                            
    'assets/webarch/css/custom.css',
    // 'assets/webarch/css/dark.css',
    // 'assets/webarch/css/default.css',
    // 'assets/webarch/css/green_lush.css',
    // 'assets/webarch/css/green.css',
    // 'assets/webarch/css/orange_coral.css',
    // 'assets/webarch/css/orange.css',
    // 'assets/webarch/css/peach.css',
    // 'assets/webarch/css/purple_aubergine.css',
    // 'assets/webarch/css/purple_virgin_america.css',
    // 'assets/webarch/css/purple.css',
    // 'assets/webarch/css/red_celestial.css',
    // 'assets/webarch/css/red.css',
    'assets/webarch/css/webarch.css',
    // 'assets/webarch/css/white.css',    
    // 'assets/webarch/plugins/fontawesome-free/css/all.min.css',
    // 'assets/webarch/plugins/bootstrapv3/css/bootstrap.min.css',
    // 'assets/webarch/plugins/datatables-1.10.24/jquery.dataTables.css',
    // 'assets/webarch/plugins/select2-4.0.8/css/select2.css',       
    // 'assets/webarch/plugins/jconfirm-3.3.4/dist/jquery-confirm.min.css'                                                   
];

// self.addEventListener('install', function(event) {
//     event.waitUntil(
//         caches.open(CACHE_NAME)
//         .then(function(cache) {
//             return cache.addAll(toCache)
//         })
//         .then(self.skipWaiting())
//     )
// })

self.addEventListener("install", (event) => {
    console.log("ServiceWorker: Installed!")

    event.waitUntil(
        
        (async() => {
            try {
                cache_obj = await caches.open(CACHE_NAME)
                cache_obj.addAll(toCache)
            }
            catch{
                console.log("ServiceWorker: Error occured while caching...")
            }
        })()
    )
} )

self.addEventListener('fetch', function(event) {
    event.respondWith(
        fetch(event.request)
        .catch(() => {
            return caches.open(CACHE_NAME)
            .then((cache) => {
                return cache.match(event.request)
            })
        })
    )
})

self.addEventListener('activate', function(event) {
    event.waitUntil(
        caches.keys()
        .then((keyList) => {
            return Promise.all(keyList.map((key) => {
            if (key !== CACHE_NAME) {
                console.log('ServiceWorker: Delete old cache', key)
                return caches.delete(key)
            }
            }))
        })
        .then(() => self.clients.claim())
    )
})