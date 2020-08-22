@extends('layouts.app')

@section('content')
    <link href="/css/carousel.css" rel="stylesheet">
    <link href="/css/signin.css" rel="stylesheet">
    <link href="/css/footer.css" rel="stylesheet">


    <div class="container-fluid">
        <div class="title ml-2">Bienvenue dans Sonyry</div>

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
                        <p>Créez votre portefolio.</p>
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
                        <p>Créez votre portefolio.</p>
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
                        <p>Créez votre portefolio.</p>
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
                        <p>Collaborez avec vos pairs sur des projets.</p>
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
                        <p>Collaborez avec vos pairs sur des projets.</p>
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
                        <p>Collaborez avec vos pairs sur des projets.</p>
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
                        <p>Partagez vos créations.</p>
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
                        <p>Partagez vos créations.</p>
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
                        <p>Partagez vos créations.</p>
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
                    pagination:false,
                    navigation: true
                }, options)
                let children = [].slice.call(element.children)
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


            }

            /**
             * Applique les bonnes dimensiosn aux éléments du carousel
             * */
            setStyle() {
                let ratio = this.items.length / this.options.slidesVisible
                this.container.style.width = (ratio * 100) + "%"
                this.items.forEach(item => item.style.width = ((100 / this.options.slidesVisible) / ratio + '%'))
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
                    if (this.items[this.currentItem + this.options.slidesVisible] === undefined) {
                        nextButton.classList.add('carousel__next--hidden')
                    } else {
                        nextButton.classList.add('carousel__next--hidden')
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
                for (let i = 0; i < this.items.length; i = i + this.options.slidesToScroll)
                {
                    let button = this.createDivWithClasse('carousel__pagination__button')
                    button.addEventListener('click', () => this.gotoItem(i))
                    pagination.appendChild(button)
                    buttons.push(button)
                }
                this.onMove(index => {
                    let activeButton = buttons[Math.floor( index / this.options.slidesToScroll)]
                    if (activeButton) {

                        buttons.forEach(buttons => buttons.classList.remove('carousel__pagination__button--active'))
                        activeButton.classList.add('carousel__pagination__button--active')
                    }
                })

            }

            next() {

                this.gotoItem(this.currentItem + this.options.slidesToScroll)
            }


            prev() {

                this.gotoItem(this.currentItem - this.options.slidesToScroll)
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
             * @param {moveCallback} cb
             * */
            onMove(cb) {
                this.moveCallbacks.push(cb)

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

        }

        let onReady = function () {

            new Carousel(document.querySelector('#carousel1'), {
                slidesVisible: 3,
                slidesToScroll: 3,
                loop: true,
                pagination: true

            })
            if (document.readyState !== 'loading')
            {

            }
        }

        document.addEventListener('DOMContentLoaded', onReady )



    </script>

@endsection
