@extends('layouts.app')

@section('content')
    <link href="/css/carousel.css" rel="stylesheet">
    <link href="/css/signin.css" rel="stylesheet">


    <div class="container-fluid" style="padding-top: 50px">

        <svg id="logo" width="278" height="56" viewBox="0 0 278 56" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M19.456 53.504C16.144 53.504 13.168 52.928 10.528 51.776C7.936 50.576 5.896 48.944 4.408 46.88C2.92 44.768 2.152 42.344 2.104 39.608H9.08801C9.328 41.96 10.288 43.952 11.968 45.584C13.696 47.168 16.192 47.96 19.456 47.96C22.576 47.96 25.024 47.192 26.8 45.656C28.624 44.072 29.536 42.056 29.536 39.608C29.536 37.688 29.008 36.128 27.952 34.928C26.896 33.728 25.576 32.816 23.992 32.192C22.408 31.568 20.272 30.896 17.584 30.176C14.272 29.312 11.608 28.448 9.592 27.584C7.624 26.72 5.92 25.376 4.48 23.552C3.088 21.68 2.392 19.184 2.392 16.064C2.392 13.328 3.088 10.904 4.48 8.79197C5.872 6.67997 7.816 5.04797 10.312 3.89597C12.856 2.74397 15.76 2.16797 19.024 2.16797C23.728 2.16797 27.568 3.34397 30.544 5.69597C33.568 8.04797 35.272 11.168 35.656 15.056H28.456C28.216 13.136 27.208 11.456 25.432 10.016C23.656 8.52797 21.304 7.78397 18.376 7.78397C15.64 7.78397 13.408 8.50397 11.68 9.94397C9.95201 11.336 9.08801 13.304 9.08801 15.848C9.08801 17.672 9.592 19.16 10.6 20.312C11.656 21.464 12.928 22.352 14.416 22.976C15.952 23.552 18.088 24.224 20.824 24.992C24.136 25.904 26.8 26.816 28.816 27.728C30.832 28.592 32.56 29.96 34 31.832C35.44 33.656 36.16 36.152 36.16 39.32C36.16 41.768 35.512 44.072 34.216 46.232C32.92 48.392 31 50.144 28.456 51.488C25.912 52.832 22.912 53.504 19.456 53.504Z"
                stroke="white" stroke-width="4"/>
            <path
                d="M68.5538 53.504C63.8978 53.504 59.6498 52.424 55.8098 50.264C51.9698 48.056 48.9218 45.008 46.6658 41.12C44.4578 37.184 43.3538 32.768 43.3538 27.872C43.3538 22.976 44.4578 18.584 46.6658 14.696C48.9218 10.76 51.9698 7.71197 55.8098 5.55197C59.6498 3.34397 63.8978 2.23997 68.5538 2.23997C73.2578 2.23997 77.5298 3.34397 81.3698 5.55197C85.2098 7.71197 88.2338 10.736 90.4418 14.624C92.6498 18.512 93.7538 22.928 93.7538 27.872C93.7538 32.816 92.6498 37.232 90.4418 41.12C88.2338 45.008 85.2098 48.056 81.3698 50.264C77.5298 52.424 73.2578 53.504 68.5538 53.504ZM68.5538 47.816C72.0578 47.816 75.2018 47 77.9858 45.368C80.8178 43.736 83.0258 41.408 84.6098 38.384C86.2418 35.36 87.0578 31.856 87.0578 27.872C87.0578 23.84 86.2418 20.336 84.6098 17.36C83.0258 14.336 80.8418 12.008 78.0578 10.376C75.2738 8.74397 72.1058 7.92797 68.5538 7.92797C65.0018 7.92797 61.8338 8.74397 59.0498 10.376C56.2658 12.008 54.0578 14.336 52.4258 17.36C50.8418 20.336 50.0498 23.84 50.0498 27.872C50.0498 31.856 50.8418 35.36 52.4258 38.384C54.0578 41.408 56.2658 43.736 59.0498 45.368C61.8818 47 65.0498 47.816 68.5538 47.816Z"
                stroke="white" stroke-width="4"/>
            <path d="M141.859 53H135.307L108.955 13.04V53H102.403V2.74397H108.955L135.307 42.632V2.74397H141.859V53Z"
                  stroke="white" stroke-width="4"/>
            <path
                d="M188.164 2.81597L171.82 34.064V53H165.268V34.064L148.852 2.81597H156.124L168.508 28.232L180.892 2.81597H188.164Z"
                stroke="white" stroke-width="4"/>
            <path
                d="M221.499 53L209.547 32.48H201.627V53H195.075V2.81597H211.275C215.067 2.81597 218.259 3.46397 220.851 4.75997C223.491 6.05597 225.459 7.80797 226.755 10.016C228.051 12.224 228.699 14.744 228.699 17.576C228.699 21.032 227.691 24.08 225.675 26.72C223.707 29.36 220.731 31.112 216.747 31.976L229.347 53H221.499ZM201.627 27.224H211.275C214.827 27.224 217.491 26.36 219.267 24.632C221.043 22.856 221.931 20.504 221.931 17.576C221.931 14.6 221.043 12.296 219.267 10.664C217.539 9.03197 214.875 8.21597 211.275 8.21597H201.627V27.224Z"
                stroke="white" stroke-width="4"/>
            <path
                d="M274.016 2.81597L257.672 34.064V53H251.12V34.064L234.704 2.81597H241.976L254.36 28.232L266.744 2.81597H274.016Z"
                stroke="white" stroke-width="4"/>
        </svg>


        <div id="carousel1">

            <div class="item">
                <div class="item__image">
                    <img src="/img/carousel1.jpg" alt="">
                </div>
                <div class="item__body">
                    <div class="item__title">
                        <h1>Créez</h1>
                    </div>
                    <div class="item__description">
                        <p>des pages et entreposez des informations</p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="item__image">
                    <img src="/img/carousel1.jpg" alt="">
                </div>
                <div class="item__body">
                    <div class="item__title">
                        <h1>Créez</h1>
                    </div>
                    <div class="item__description">
                        <p>des collections en regroupant vos pages</p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="item__image">
                    <img src="/img/carousel1.jpg" alt="">
                </div>
                <div class="item__body">
                    <div class="item__title">
                        <h1>Créez</h1>
                    </div>
                    <div class="item__description">
                        <p>vos propres groupes</p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="item__image">
                    <img src="/img/carousel2.jpg" alt="">
                </div>
                <div class="item__body">
                    <div class="item__title">
                        <h1>Collaborez</h1>
                    </div>
                    <div class="item__description">
                        <p>avec vos pairs sur des projets</p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="item__image">
                    <img src="/img/carousel2.jpg" alt="">
                </div>
                <div class="item__body">
                    <div class="item__title">
                        <h1>Collaborez</h1>
                    </div>
                    <div class="item__description">
                        <p>au sein de vos groupes</p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="item__image">
                    <img src="/img/carousel2.jpg" alt="">
                </div>
                <div class="item__body">
                    <div class="item__title">
                        <h1>Collaborez</h1>
                    </div>
                    <div class="item__description">
                        <p>sur notre forum</p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="item__image">
                    <img src="/img/carousel3.jpg" alt="">
                </div>
                <div class="item__body">
                    <div class="item__title">
                        <h1>Partagez</h1>
                    </div>
                    <div class="item__description">
                        <p>vos pages avec les utilisateurs de Sonyry</p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="item__image">
                    <img src="/img/carousel3.jpg" alt="">
                </div>
                <div class="item__body">
                    <div class="item__title">
                        <h1>Partagez</h1>
                    </div>
                    <div class="item__description">
                        <p>votre expérience avec les utilisateurs de Sonyry </p>
                    </div>
                </div>
            </div>

            <div class="item">
                <div class="item__image">
                    <img src="/img/carousel3.jpg" alt="">
                </div>
                <div class="item__body">
                    <div class="item__title">
                        <h1>Partagez</h1>
                    </div>
                    <div class="item__description">
                        <p>vos connaissances et vos compétences</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <br>






    <script async>
        class Carousel {

            /**
             * This callback is displayed as part of the Requester class.
             * @callback moveCallback
             * @param {number} index
             */

            /**
             *
             * @param {HTMLElement} element
             * @param {Object} options
             * @param {Object} [options.slidesToScroll=1] éléments à faire défiler
             * @param {Object} [options.slidesVisible=1] éléments visibles dans un slide
             * @param {Boolean} [options.loop=false] Doit-t-on boucler en fin de carousel ?
             * @param {Boolean} [options.pagination=false]
             */

            constructor(element, options = {}) {
                this.element = element
                this.options = Object.assign({}, {
                    slidesToScroll: 1,
                    slidesVisible: 1,
                    loop: false,
                    pagination: false,
                    navigation: true
                }, options)
                let children = [].slice.call(element.children)
                this.isMobile = true
                this.currentItem = 0
                this.root = this.createDivWithClasse('carousel')
                this.container = this.createDivWithClasse('carousel__container')
                this.root.appendChild(this.container)
                this.element.appendChild(this.root)
                this.moveCallbacks = []
                this.items = children.map((child) => {
                    let item = this.createDivWithClasse('carousel__item')

                    item.appendChild(child)
                    this.container.appendChild(item)
                    return item
                })
                this.setStyle()
                if (this.options.navigation) {
                    this.createNavigation()
                }
                if (this.options.pagination) {
                    this.createPagination()
                }

                this.moveCallbacks.forEach(cb => cb(0))
                this.onWindowResize()
                window.addEventListener('resize', this.onWindowResize.bind(this))


            }

            /**
             * Applique les bonnes dimensiosn aux éléments du carousel
             * */
            setStyle() {
                let ratio = this.items.length / this.slidesVisible
                this.container.style.width = (ratio * 100) + "%"
                this.items.forEach(item => item.style.width = ((100 / this.slidesVisible) / ratio + '%'))
            }

            /**
             * Créer les flèches de la navigation
             * */

            createNavigation() {
                let nextButton = this.createDivWithClasse('carousel__next')
                let prevButton = this.createDivWithClasse('carousel__prev')
                this.root.appendChild(nextButton)
                this.root.appendChild(prevButton)
                nextButton.addEventListener('click', this.next.bind(this))
                prevButton.addEventListener('click', this.prev.bind(this))
                if (this.options.loop === true) {
                    return
                }
                this.onMove(index => {
                    if (index === 0) {
                        prevButton.classList.add('carousel__prev--hidden')
                    } else {
                        prevButton.classList.remove('carousel__prev--hidden')
                    }
                    if (this.items[this.currentItem + this.slidesVisible] === undefined) {
                        nextButton.classList.add('carousel__next--hidden')
                    } else {
                        nextButton.classList.remove('carousel__next--hidden')
                    }
                })

            }

            /**
             * Créer la pagination
             * */

            createPagination() {
                let pagination = this.createDivWithClasse('carousel__pagination')
                let buttons = []
                this.root.appendChild(pagination)
                for (let i = 0; i < this.items.length; i = i + this.options.slidesToScroll) {
                    let button = this.createDivWithClasse('carousel__pagination__button')
                    button.addEventListener('click', () => this.gotoItem(i))
                    pagination.appendChild(button)
                    buttons.push(button)
                }
                this.onMove(index => {
                    let activeButton = buttons[Math.floor(index / this.options.slidesToScroll)]
                    if (activeButton) {
                        buttons.forEach(buttons => buttons.classList.remove('carousel__pagination__button--active'))
                        activeButton.classList.add('carousel__pagination__button--active')
                    }
                })

            }

            next() {

                this.gotoItem(this.currentItem + this.slidesToScroll)
            }


            prev() {

                this.gotoItem(this.currentItem - this.slidesToScroll)
            }


            /**
             * Déplace le carousel vers l'élément ciblé
             * @param {number} index
             */

            gotoItem(index) {

                if (index < 0) {
                    index = this.items.length - this.options.slidesVisible
                } else if (index >= this.items.length || (this.items[this.currentItem + this.options.slidesVisible] === undefined && index > this.currentItem)) {

                    index = 0
                }


                let translateX = index * -100 / this.items.length
                this.container.style.transform = 'translate3d(' + translateX + '%, 0, 0)'
                this.currentItem = index
                this.moveCallbacks.forEach(cb => cb(index))

            }

            /**
             * @param {function(*): void} cb
             * */
            onMove(cb) {
                this.moveCallbacks.push(cb)

            }

            onWindowResize() {
                let mobile = window.innerWidth < 800
                if (mobile !== this.isMobile) {
                    this.isMobile = mobile
                    this.setStyle()
                    this.moveCallbacks.forEach(cb => cb(this.currentItem))
                }
            }

            /**
             *
             * @param {string} className
             * @returns {HTMLElement}
             */
            createDivWithClasse(className) {
                let div = document.createElement('div')
                div.setAttribute('class', className)
                return div
            }


            /**
             *
             * @returns {number}
             */
            get slidesToScroll() {
                return this.isMobile ? 1 : this.options.slidesToScroll

            }

            /**
             *
             * @returns {number}
             */
            get slidesVisible() {
                return this.isMobile ? 1 : this.options.slidesVisible

            }
        }

        let onReady = function () {

            new Carousel(document.querySelector('#carousel1'), {
                slidesVisible: 3,
                slidesToScroll: 3,
                loop: true,
                pagination: true

            })
            if (document.readyState !== 'loading') {

            }
        }

        document.addEventListener('DOMContentLoaded', onReady)


        const logo = document.querySelectorAll("#logo path");

        for (let i = 0; i < logo.length; i++) {
            console.log(`Letter ${i} is ${logo[i].getTotalLength()}`)
        }


    </script>



@endsection
