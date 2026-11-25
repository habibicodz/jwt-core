# JWT From Scratch (PHP)

A from-scratch implementation of JSON Web Tokens (JWT) in PHP.

## Why?

This project exists **solely for learning purposes** — specifically to understand how JWT works behind the scenes, from a cybersecurity perspective.

Rather than relying on an existing library, every piece is built by hand (Base64URL encoding, header/payload construction, HMAC signing, token assembly) so the mechanics are fully visible and understood, not hidden behind an abstraction.

The goal is to follow the official RFC specifications closely.

## References

- [RFC 7515 — JSON Web Signature (JWS): information page](https://www.rfc-editor.org/info/rfc7515/)
- [RFC 7515 — full specification on a single page](https://www.rfc-editor.org/rfc/rfc7515.html)

Both links refer to the same specification, but serve different purposes. The `info` page is the RFC Editor's landing page: it shows the document's status, authors, publication history, and links to every available format. The `/rfc/` page renders the entire specification in one page, which is convenient for reading it end-to-end while implementing the signing flow.

## Status

Work in progress. Not intended for production use — this is a learning exercise, not a hardened library.
