import Vue from 'vue';
import moment from "moment";
export const articleMixin = {
        methods: {
            truncateText(text, fromLength, toLength) {
                if (text.length > 30) {
                    return `${text.substr(fromLength, toLength)} ...`;
                }
                return text;
            },
            dateFormat(timestamp) {
                if (timestamp) {
                    return moment(String(timestamp)).format('MM/DD/YYYY hh:mm')
                }
            },
        }
}
