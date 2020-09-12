// import {mapGetters} from 'vuex'
//
//
// export default async ({Vue}) => {
//     Vue.mixin({
//         methods: {
//             $can(abilities) {
//                 let role = abilities
//
//                 if (this.permissions) {
//                     let permissions = this.permissions.split(',')
//                     // console.log(permissions, role, !permissions.some(val => role.indexOf(val) === -1))
//                     return permissions.includes(role);
//                 }
//             }
//         },
//         computed: {
//             ...mapGetters('auth', ['permissions'])
//         }
//     })
// }
