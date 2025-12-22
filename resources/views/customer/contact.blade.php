@extends('customer.layout')

@section('customer')

<div class="alert" role="alert">
    <h2>Contact With Us</h2>
    <h5>Leave a message. We love to hear from you</h5>
</div>

<section class="contact">
    <div class="detail">
        <span>Get in touch</span>
        <h2>Visit one of our agency locations or contact us today</h2>
        <h3>Head Office</h3>
        <div>
            <ul>
                <li>
                    <i class="bi bi-map-fill"></i>
                    <p>Trường Đại học Công nghệ thông tin và Việt-Hàn</p>
                </li>
                <li>
                    <i class="bi bi-envelope"></i>
                    <p>contact@gmail.com</p>
                </li>
                <li>
                    <i class="bi bi-telephone-fill"></i>
                    <p>xxx.xxx.xxx.xxx</p>
                </li> 
            </ul>
        </div>
    </div>
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3685.906743254015!2d108.25168204321453!3d15.974930220575489!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIFZp4buHdCAtIEjDoG4sIMSQ4bqhaSBo4buNYyDEkMOgIE7hurVuZw!5e1!3m2!1svi!2s!4v1747287526079!5m2!1svi!2s"
            width="400" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<section id="form-input" class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-sm border-1 rounded-4">
                    <div class="card-body p-4">
                        <h3 class="text-center fw-bold mb-1">Leave a message</h3>
                        <p class="text-center text-muted mb-4">
                            We love to hear from you
                        </p>
                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Your Name</label>
                                <input type="text" 
                                       name="name" 
                                       class="form-control rounded-3"
                                       placeholder="Enter your name"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" 
                                       name="email" 
                                       class="form-control rounded-3"
                                       placeholder="Enter your email"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subject</label>
                                <input type="text" 
                                       name="subject" 
                                       class="form-control rounded-3"
                                       placeholder="Subject"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea name="message" 
                                          class="form-control rounded-3"
                                          rows="4"
                                          placeholder="Write your message..."
                                          required></textarea>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" 
                                        class="btn btn-outline-secondary btn-lg rounded-pill">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection