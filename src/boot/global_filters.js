import {mapGetters} from 'vuex'


export default async ({Vue}) => {
    Vue.filter('firstCaps', function (string) {
        if (string == null) {
            return
        }
        return (
            string.charAt(0).toUpperCase() + string.slice(1).toLowerCase()
        )
    });

    Vue.filter('formatAmount', function (amount) {
        if (!amount) {
            return '0.00'
        }
        return parseFloat(amount).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',')
    });



    Vue.filter('trimString', function (string, length=20) {
        return string.length > length ? string.substring(0, length) + "..." : string;
    });
}
