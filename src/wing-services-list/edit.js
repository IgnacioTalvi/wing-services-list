/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useState } from '@wordpress/element';
import {
	useBlockProps,
	RichText,
	MediaUpload,
	MediaUploadCheck,
	InspectorControls,
	__experimentalLinkControl as LinkControl,
} from '@wordpress/block-editor';
import {
	Button,
	PanelBody,
	RangeControl,
	Popover,
} from '@wordpress/components';

import './editor.scss';

function generateServiceId() {
	return `service-${ Date.now() }-${ Math.floor( Math.random() * 1000 ) }`;
}

export default function Edit( { attributes, setAttributes } ) {
	const { heading, subheading, columns, services } = attributes;
	const [ activeLinkPicker, setActiveLinkPicker ] = useState( null );

	const updateService = ( index, updates ) => {
		const newServices = services.map( ( service, i ) =>
			i === index ? { ...service, ...updates } : service
		);
		setAttributes( { services: newServices } );
	};

	const addService = () => {
		const newService = {
			id: generateServiceId(),
			title: __( 'New Service', 'wing-services-list' ),
			description: __(
				'A short description of this service.',
				'wing-services-list'
			),
			imageId: 0,
			imageUrl: '',
			imageAlt: '',
			linkUrl: '',
			linkLabel: __( 'Learn More', 'wing-services-list' ),
			linkOpenInNewTab: false,
		};
		setAttributes( { services: [ ...services, newService ] } );
	};

	const removeService = ( index ) => {
		const newServices = services.filter( ( _, i ) => i !== index );
		setAttributes( { services: newServices } );
	};

	const blockProps = useBlockProps( {
		className: `wing-services wing-services--cols-${ columns }`,
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Layout', 'wing-services-list' ) }>
					<RangeControl
						label={ __( 'Columns', 'wing-services-list' ) }
						value={ columns }
						onChange={ ( value ) =>
							setAttributes( { columns: value } )
						}
						min={ 2 }
						max={ 4 }
					/>
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<header className="wing-services__header">
					<RichText
						tagName="h2"
						className="wing-services__heading"
						value={ heading }
						onChange={ ( value ) =>
							setAttributes( { heading: value } )
						}
						placeholder={ __(
							'Section heading…',
							'wing-services-list'
						) }
						allowedFormats={ [] }
					/>
					<RichText
						tagName="p"
						className="wing-services__subheading"
						value={ subheading }
						onChange={ ( value ) =>
							setAttributes( { subheading: value } )
						}
						placeholder={ __(
							'Section subheading…',
							'wing-services-list'
						) }
						allowedFormats={ [ 'core/italic' ] }
					/>
				</header>

				<div className="wing-services__grid">
					{ services.map( ( service, index ) => (
						<article
							key={ service.id }
							className="wing-services__card"
						>
							<MediaUploadCheck>
								<MediaUpload
									onSelect={ ( media ) =>
										updateService( index, {
											imageId: media.id,
											imageUrl: media.url,
											imageAlt: media.alt || '',
										} )
									}
									allowedTypes={ [ 'image' ] }
									value={ service.imageId }
									render={ ( { open } ) => (
										<div className="wing-services__media">
											{ service.imageUrl ? (
												<div className="wing-services__media-wrapper">
													<img
														src={ service.imageUrl }
														alt={ service.imageAlt }
													/>
													<Button
														variant="primary"
														size="small"
														onClick={ open }
														className="wing-services__media-replace"
													>
														{ __(
															'Replace',
															'wing-services-list'
														) }
													</Button>
												</div>
											) : (
												<Button
													variant="secondary"
													onClick={ open }
													className="wing-services__media-button"
												>
													{ __(
														'Select image',
														'wing-services-list'
													) }
												</Button>
											) }
										</div>
									) }
								/>
							</MediaUploadCheck>

							<RichText
								tagName="h3"
								className="wing-services__card-title"
								value={ service.title }
								onChange={ ( value ) =>
									updateService( index, { title: value } )
								}
								placeholder={ __(
									'Service title…',
									'wing-services-list'
								) }
								allowedFormats={ [] }
							/>

							<RichText
								tagName="p"
								className="wing-services__card-description"
								value={ service.description }
								onChange={ ( value ) =>
									updateService( index, {
										description: value,
									} )
								}
								placeholder={ __(
									'Service description…',
									'wing-services-list'
								) }
								allowedFormats={ [ 'core/italic', 'core/bold' ] }
							/>

							<div className="wing-services__link-controls">
								<RichText
									tagName="span"
									className="wing-services__card-link-label"
									value={ service.linkLabel }
									onChange={ ( value ) =>
										updateService( index, {
											linkLabel: value,
										} )
									}
									placeholder={ __(
										'Button label…',
										'wing-services-list'
									) }
									allowedFormats={ [] }
								/>
								<Button
									variant="tertiary"
									size="small"
									onClick={ () =>
										setActiveLinkPicker(
											activeLinkPicker === index
												? null
												: index
										)
									}
									className="wing-services__link-edit"
								>
									{ service.linkUrl
										? __(
												'Edit link',
												'wing-services-list'
										  )
										: __(
												'Add link',
												'wing-services-list'
										  ) }
								</Button>
								{ activeLinkPicker === index && (
									<Popover
										position="bottom center"
										onClose={ () =>
											setActiveLinkPicker( null )
										}
										focusOnMount="firstElement"
									>
										<LinkControl
											value={ {
												url: service.linkUrl,
												opensInNewTab:
													service.linkOpenInNewTab,
											} }
											onChange={ ( newLink ) => {
												updateService( index, {
													linkUrl: newLink.url || '',
													linkOpenInNewTab:
														newLink.opensInNewTab ||
														false,
												} );
											} }
											settings={ [
												{
													id: 'opensInNewTab',
													title: __(
														'Open in new tab',
														'wing-services-list'
													),
												},
											] }
										/>
									</Popover>
								) }
							</div>

							<Button
								variant="link"
								isDestructive
								onClick={ () => removeService( index ) }
								className="wing-services__remove"
							>
								{ __( 'Remove', 'wing-services-list' ) }
							</Button>
						</article>
					) ) }
				</div>

				<div className="wing-services__add">
					<Button variant="primary" onClick={ addService }>
						{ __( 'Add service', 'wing-services-list' ) }
					</Button>
				</div>
			</div>
		</>
	);
}