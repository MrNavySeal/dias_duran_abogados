<section class="mt-5 mb-5 bg-color-2" v-if="arrTestimonios && arrTestimonios.length > 0">
    <div>
        <div class="testimonial">
            <img src="" alt="">
            <div class="testimonial-container">
                <div class="testimonial-content container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="testimonial-titles">
                                <h5 class="t-color-1 fw-bold fs-3">Testimonios</h5>
                                <h2 class="t-color-4 mb-5 fs-11 fw-bold">Lo que dicen nuestros clientes de nosotros</h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="carousel-testimonial owl-carousel owl-theme" data-bs-ride="carousel">
                                <div class="testimonial-info" v-for="(data,index) in arrTestimonios" :key="index">
                                    <div class="testimonial-img" v-if="data.url != ''">
                                        <img :src="data.url" :alt="data.name">
                                    </div>
                                    <div class="testimonial-description">
                                        <h6 class="t-color-2 fs-3 fw-bold">{{data.name}}</h6>
                                        <span class="t-color-1 fw-bold">{{data.profession}}</span>
                                        <p>"{{data.description}}"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>