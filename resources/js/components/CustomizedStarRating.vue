<template>
    <div style="align-content: center">
        <b-row class="align-content-center" @mouseleave="showCurrentRating">
            <b-col class="align-content-center">
                <star-rating
                    :read-only=isUserRated
                    v-bind:rating=object.overall_rating
                    v-bind:star-size="20"
                    v-bind:increment="0.5"
                    :glow="10"
                    :rounded-corners="true"
                    :show-rating="false" @current-rating="showCurrentRating"
                    @rating-selected="setCurrentSelectedRating">
                </star-rating>
            </b-col>
<!--            <b-col class="align-content-center">-->
<!--                <span style="font-weight:bold;">{{ ratingDesc }}</span>-->
<!--            </b-col>-->
        </b-row>
    </div>
</template>

<script>
    export default {
        name: "CustomizedStarRating",
        props: ['object', 'type'],
        data() {
            return {
                numOfRatings: this.object.ratings ? this.object.ratings.length : 0,
                ratingDesc: this.object.is_rated && this.ratings ? this.ratings.length : 'No reviews yet.',
                isUserRated: false,
                notYetRated: "Not yet rated",
                overallRating: this.object.overall_rating,
            };
        },
        mounted() {
           /* console.log("this data = ", this.ratings);
            console.log('rating desc = ', this.ratingDesc)
            console.log("is_rated?", this.object.is_rated);
            console.log("user_id = ", this.$userId);*/
        },
        methods: {

            determindIfUserRated: function () {
                //return this.objectRatings.
            },

            showCurrentRating: function (rating) {
                (this.object.is_rated) ? this.ratingDesc = this.numOfRatings : this.notYetRated;
            },

            setCurrentSelectedRating: function (rating) {
                console.log("number of Ratings = ", this.numOfRatings);
                if (!this.isUserRated) {
                    let formData = new FormData();
                    formData.append(this.type + "_id", this.object.id);
                    formData.append("rating", rating);
                    axios
                        .post("/rating/rate_" + this.type, formData, {
                            headers: {"Content-Type": "multipart/form-data"}
                        })
                        .then(res => {
                            this.numOfRatings++;
                            this.ratingDesc = 'You rated this ' + this.type + ' ' + rating + ' stars!';
                            this.isUserRated = true;
                            this.overallRating = res.new_rating;
                        });
                }
                console.log("number of Ratings = ", this.numOfRatings);
            },
        }
    }
</script>

<style scoped>

</style>
