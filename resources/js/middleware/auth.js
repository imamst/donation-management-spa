import User from '../apis/User'

const authCheck = (next, roles = null) => {
    User.auth()
        .then(response => {
            
            if(roles != null) {
                // if user role allowed
                if(roles.includes(response.data.role)) {
                    return next()
                }
                else {
                    return next({
                        path: '/forbidden'
                    })
                }
            }
            else {
                return next()
            }
        })
        .catch(() => {
            return next({
                path: '/login'
                // query: { redirect: toRoute.fullPath }
            })
        })
}

const guestCheck = (next) => {
    User.auth()
        .then(response => {

            return next({
                path: '/'
                // query: { redirect: toRoute.fullPath },            
            })
        })
        .catch(() => {
            return next()
        })
}

export {authCheck, guestCheck}