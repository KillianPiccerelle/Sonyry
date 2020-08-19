@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="title">Bienvenue dans Sonyry</div>

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



    <footer class="footerCopyright">
        <div class="container text-center"><small style="color: white; padding-bottom: -0.5rem">Copyright 2020 ©
                Sonyry</small></div>
    </footer>


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
             */

            constructor(element, options = {}) {
                this.element = element
                this.options = Object.assign({}, {
                    slidesToScroll: 1,
                    slidesVisible: 1,
                    loop: false
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
                this.createNavigation()
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
                        prevButton.classList.remove('carousel__prev--hideen')
                    }
                    if (this.items[this.currentItem + this.options.slidesVisible] === undefined) {
                        nextButton.classList.add('carousel__next--hidden')
                    } else {
                        nextButton.classList.add('carousel__next--hidden')
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

        document.addEventListener('DOMContentLoaded', function () {

            new Carousel(document.querySelector('#carousel1'), {
                slidesVisible: 3,
                slidesToScroll: 1,
                loop: true

            })

        })




    </script>

@endsection
