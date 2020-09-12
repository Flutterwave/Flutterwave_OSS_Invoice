const routes = [
    // Public routes
    {
        path: '/',
        component: () => import('layouts/public/PublicLayout.vue'),
        children: [
            {
                path: '',
                redirect: {
                    name: 'login'
                }
            },
            {
                path: '/login',
                name: 'login',
                component: () => import('pages/public/LoginTemplate.vue'),
                meta: { requiresAuth: false }
            }
        ]
    },

    // Auth routes
    {
        path: '/',
        component: () => import('layouts/auth/MainLayout.vue'),
        children: [
            {
                path: '',
                redirect: {
                    name: 'invoices'
                }
            },
            {
                path: '/invoices',
                name: 'invoices',
                component: () => import('pages/auth/Invoices.vue'),
                children: [
                    {
                        path: '',
                        component: () => import('pages/auth/invoices/InvoicesListing.vue'),
                        meta: { requiresAuth: true }
                    },
                    {
                        path: 'create',
                        component: () => import('pages/auth/invoices/NewInvoice.vue'),
                        props: true,
                        meta: { requiresAuth: true }
                    },
                    {
                        path: ':id',
                        component: () => import('pages/auth/invoices/InvoiceDetails.vue'),
                        props: true,
                        meta: { requiresAuth: true }
                    }
                ]
            },
            {
                path: '/clients',
                component: () => import('pages/auth/Customers.vue'),
                children: [
                    {
                        path: '',
                        component: () => import('pages/auth/customers/CustomersListing.vue'),
                        meta: { requiresAuth: true }
                    }
                ]
            },

        ]
    }
]

// Always leave this as last one
if (process.env.MODE !== 'ssr') {
    routes.push({
        path: '*',
        component: () => import('pages/Error404.vue'),
        meta: { requiresAuth: true }
    })
}

export default routes
